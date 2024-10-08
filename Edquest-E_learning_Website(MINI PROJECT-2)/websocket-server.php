<?php
// Adjust the paths to where you have cloned the necessary libraries
require __DIR__ . '\Ratchet-master\Ratchet-master\src\Ratchet\ConnectionInterface.php';
require __DIR__ . '\Ratchet-master\Ratchet-master\src\Ratchet\Server\IoServer.php';
require __DIR__ . '\Ratchet-master\Ratchet-master\src\Ratchet\Http\HttpServer.php';
require __DIR__ . '\Ratchet-master\Ratchet-master\src\Ratchet\WebSocket\WsServer.php';

// Include necessary files for dependencies (adjust paths as necessary)
require __DIR__ . '\vendor\guzzlehttp\guzzle\src\functions_include.php';
require __DIR__ . '\vendor\react\event-loop\src\LoopInterface.php';
require __DIR__ . '\vendor\react\event-loop\src\StreamSelectLoop.php';
require __DIR__ . '\vendor\react\socket\src\Connector.php';
require __DIR__ . '\vendor\react\socket\src\Server.php';
require __DIR__ . '\vendor\react\socket\src\ConnectionInterface.php';
require __DIR__ . '\vendor\react\stream\src\ReadableStreamInterface.php';
require __DIR__ . '\vendor\react\stream\src\WritableStreamInterface.php';
require __DIR__ . '\vendor\react\stream\src\DuplexStreamInterface.php';
require __DIR__ . '\vendor\react\stream\src\Util.php';
require __DIR__ . '\vendor\react\stream\src\ReadableStream.php';
require __DIR__ . '\vendor\react\stream\src\WritableStream.php';
require __DIR__ . '\vendor\react\stream\src\DuplexStream.php';

use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;
use Ratchet\Server\IoServer;
use Ratchet\Http\HttpServer;
use Ratchet\WebSocket\WsServer;

class TicTacToe implements MessageComponentInterface {
    protected $clients;
    protected $games;
    protected $users;

    public function __construct() {
        $this->clients = new \SplObjectStorage;
        $this->games = [];
        $this->users = [];
    }

    public function onOpen(ConnectionInterface $conn) {
        $this->clients->attach($conn);
        echo "New connection! ({$conn->resourceId})\n";
    }

    public function onMessage(ConnectionInterface $from, $msg) {
        $data = json_decode($msg);
        $userId = $data->userId;
        $action = $data->action;

        if ($action === 'join') {
            $this->users[$userId] = $from;
            $this->findGame($userId);
        } elseif ($action === 'move') {
            $gameId = $data->gameId;
            $move = $data->move;
            $this->makeMove($gameId, $userId, $move);
        }
    }

    public function onClose(ConnectionInterface $conn) {
        $this->clients->detach($conn);
        echo "Connection {$conn->resourceId} has disconnected\n";
    }

    public function onError(ConnectionInterface $conn, \Exception $e) {
        echo "An error has occurred: {$e->getMessage()}\n";
        $conn->close();
    }

    private function findGame($userId) {
        foreach ($this->games as $gameId => $game) {
            if (count($game['players']) === 1) {
                $this->games[$gameId]['players'][] = $userId;
                $this->startGame($gameId);
                return;
            }
        }

        $gameId = uniqid();
        $this->games[$gameId] = [
            'players' => [$userId],
            'board' => array_fill(0, 9, null),
            'turn' => $userId
        ];
        $this->users[$userId]->send(json_encode(['action' => 'wait', 'gameId' => $gameId]));
    }

    private function startGame($gameId) {
        $game = $this->games[$gameId];
        $players = $game['players'];
        $this->users[$players[0]]->send(json_encode(['action' => 'start', 'gameId' => $gameId, 'symbol' => 'X']));
        $this->users[$players[1]]->send(json_encode(['action' => 'start', 'gameId' => $gameId, 'symbol' => 'O']));
    }

    private function makeMove($gameId, $userId, $move) {
        $game = $this->games[$gameId];
        if ($game['turn'] !== $userId || $game['board'][$move] !== null) {
            return;
        }

        $symbol = $game['players'][0] === $userId ? 'X' : 'O';
        $game['board'][$move] = $symbol;
        $game['turn'] = $game['players'][0] === $userId ? $game['players'][1] : $game['players'][0];
        $this->games[$gameId] = $game;

        foreach ($game['players'] as $player) {
            $this->users[$player]->send(json_encode(['action' => 'move', 'gameId' => $gameId, 'board' => $game['board']]));
        }

        if ($this->checkWin($game['board'], $symbol)) {
            foreach ($game['players'] as $player) {
                $this->users[$player]->send(json_encode(['action' => 'end', 'gameId' => $gameId, 'winner' => $userId]));
            }
        }
    }

    private function checkWin($board, $symbol) {
        $winningCombinations = [
            [0, 1, 2], [3, 4, 5], [6, 7, 8],
            [0, 3, 6], [1, 4, 7], [2, 5, 8],
            [0, 4, 8], [2, 4, 6]
        ];

        foreach ($winningCombinations as $combination) {
            if ($board[$combination[0]] === $symbol && $board[$combination[1]] === $symbol && $board[$combination[2]] === $symbol) {
                return true;
            }
        }

        return false;
    }
}

$server = IoServer::factory(
    new HttpServer(
        new WsServer(
            new TicTacToe()
        )
    ),
    8081
);

$server->run();
