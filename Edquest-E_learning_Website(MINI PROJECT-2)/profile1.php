<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="shortcut icon" type="png" href="images/icon/favicon.png">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>EdQuests</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="style.css">
    <script src="loader.js"></script>
    <script>
        $(document).ready(function() {
            // Retrieve userId from localStorage or another method
            let userId = localStorage.getItem('userId');

            if (userId) {
                let encodedUserId = encodeURIComponent(userId);
                let profileLink = `http://localhost:81/verify/Edquest-E_learning_Website(MINI%20PROJECT-2)/profilemodel.html?user_id=${encodedUserId}`;
                $('#profile-link').attr('href', profileLink);
            } else {
                console.error('User ID not found.');
            }
        });
    </script>
</script>
    <script>
        $(document).ready(function() {
            // Function to set up the profile link
            function setupProfileLink() {
                // Retrieve the userId from localStorage or another source
                let userId = localStorage.getItem('userId');
                
                if (userId) {
                    // Update the href of the profile link to include the userId
                    $('#profile-link').attr('href', `http://localhost:81/verify/Edquest-E_learning_Website(MINI%20PROJECT-2)/profilemodel.html?user_id=${userId}`);
                } else {
                    console.error('User ID not found.');
                }
            }

            // Initialize profile link setup
            setupProfileLink();

            // Optional: If you want to handle the link click event explicitly
            $('#profile-link').click(function(e) {
                e.preventDefault(); // Prevent the default link behavior
                let userId = localStorage.getItem('userId');
                if (userId) {
                    window.location.href = `http://localhost:81/verify/Edquest-E_learning_Website(MINI%20PROJECT-2)/profilemodel.html?user_id=${userId}`;
                } else {
                    console.error('User ID not found.');
                }
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            // Retrieve userId from localStorage or URL
            let userId = localStorage.getItem('userId');
            if (!userId) {
                const urlParams = new URLSearchParams(window.location.search);
                userId = urlParams.get('user_id');
                if (userId) {
                    localStorage.setItem('userId', userId);
                }
            }

            // Update the profile link with userId
            if (userId) {
                $('#profile-link').attr('href', `profilemodel.html?user_id=${userId}`);
            }
        });
    </script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="loader.js"></script>

    <script>
        $(document).ready(function() {
            const urlParams = new URLSearchParams(window.location.search);
            let userId = urlParams.get('user_id');
            
            if (userId) {
                localStorage.setItem('userId', userId);
            } else {
                userId = localStorage.getItem('userId');
            }

            if (userId) {
                $.ajax({
                    url: 'http://localhost:81/verify/Edquest-E_learning_Website(MINI%20PROJECT-2)/get_user_info.php?user_id=' + userId,
                    type: 'GET',
                    success: function(response) {
                        const user = JSON.parse(response);
                        if (user) {
                            $('#profile-info').html(`
                                <h2>Personal Information</h2>
                                <p>Name: ${user.fullname}</p>
                                <p>Email: ${user.email}</p>
                                <p>Location: ${user.location}</p>
                                <p>Age: ${user.age}</p>
                                <p>Interests: ${user.interests}</p>
                                <p>Course Name: ${user.course_name}</p>
                                <p>Start Date: ${user.start_date}</p>
                                <p>Duration of Course: ${user.duration} weeks</p>
                            <a href="http://localhost:81/verify/Edquest-E_learning_Website(MINI%20PROJECT-2)/logout.php" class="profile-link">Logout</a>
                            <a href="http://localhost:81/verify/Edquest-E_learning_Website(MINI%20PROJECT-2)/update.html?user_id=${userId}" class="profile-link">Edit Profile</a>


                            `);
                            filterCourses(user.interests, user.course_name);
                        }
                    }
                });
            }
            

            function filterCourses(interests, courseName) {
                const allCourses = [
                    { name: 'JEE Preparation', url: 'subjects/jee.html', img: 'images/courses/book.png' },
                    { name: 'GATE Preparation', url: 'subjects/gate.html', img: 'images/courses/d1.png' },
                    { name: 'Sample Papers', url: 'subjects/jee.html#sample_papers', img: 'images/courses/paper.png' },
                    { name: 'Daily Quiz', url: 'subjects/quiz.html', img: 'images/courses/d1.png' },
                    { name: 'Computer Courses', url: 'subjects/computer_courses.html', img: 'images/courses/computer.png' },
                    { name: 'Data Structures', url: 'subjects/computer_courses.html#data', img: 'images/courses/data.png' },
                    { name: 'Algorithm', url: 'subjects/computer_courses.html#algo', img: 'images/courses/algo.png' },
                    { name: 'Projects', url: 'subjects/computer_courses.html#projects', img: 'images/courses/projects.png' }
                ];

                let filteredCourses = allCourses;

                if (interests || courseName) {
                    const keywords = (interests + ',' + courseName).toLowerCase().split(',').map(s => s.trim());
                    filteredCourses = allCourses.filter(course =>
                        keywords.some(keyword => course.name.toLowerCase().includes(keyword))
                    );
                }

                displayCourses(filteredCourses);
            }
            

            function displayCourses(courses) {
                const courseContainer = $('.course .cbox');
                courseContainer.empty();
                if (courses.length === 0) {
                    courseContainer.append('<p>No courses found. <button id="explore-all-courses">Explore All Courses</button></p>');
                    $('#explore-all-courses').click(function() {
                        showAllCourses();
                    });
                } else {
                    courses.forEach(course => {
                        courseContainer.append(`
                            <div class="det"><a href="${course.url}"><img src="${course.img}">${course.name}</a></div>
                        `);
                    });
                }
            }

          

            function showAllCourses() {
                const allCourses = [
                    { name: 'JEE Preparation', url: 'subjects/jee.html', img: 'images/courses/book.png' },
                    { name: 'GATE Preparation', url: 'subjects/gate.html', img: 'images/courses/d1.png' },
                    { name: 'Sample Papers', url: 'subjects/jee.html#sample_papers', img: 'images/courses/paper.png' },
                    { name: 'Daily Quiz', url: 'subjects/quiz.html', img: 'images/courses/d1.png' },
                    { name: 'Computer Courses', url: 'subjects/computer_courses.html', img: 'images/courses/computer.png' },
                    { name: 'Data Structures', url: 'subjects/computer_courses.html#data', img: 'images/courses/data.png' },
                    { name: 'Algorithm', url: 'subjects/computer_courses.html#algo', img: 'images/courses/algo.png' },
                    { name: 'Projects', url: 'subjects/computer_courses.html#projects', img: 'images/courses/projects.png' }
                ];

                const courseContainer = $('.course .cbox');
                courseContainer.empty();
                allCourses.forEach(course => {
                    courseContainer.append(`
                        <div class="det"><a href="${course.url}"><img src="${course.img}">${course.name}</a></div>
                    `);
                });
                courseContainer.append(`
    <p style="text-align:center; font-size: 16px; color: #333;">
        Visit 
        <a href="index.html" style="text-decoration: none; color: #007BFF;">
            <img src="images/icon/name.png" alt="Homepage Icon" style="width: 20px; height: 20px; margin-right: 5px; vertical-align: middle;">
            Homepage
        </a> 
        to explore all courses properly.
    </p>
`);

            }

            $('#sidebar-toggle').click(function() {
                $('.sidebar').toggleClass('active');
                if ($('.sidebar').hasClass('active')) {
                    $('.main').css('margin-left', '0');
                    $(this).css('background-color', 'transparent');
                } else {
                    $('.main').css('margin-left', '200px');
                    $(this).css('background-color', 'transparent');
                }
            });
        });
    </script>
    <style>
body {
    font-family: Arial, sans-serif;  /* Sets the font family for the entire page to Arial or a generic sans-serif font */
    margin: 0;  /* Removes default margin from the body */
    padding: 0;  /* Removes default padding from the body */
    box-sizing: border-box;  /* Ensures that padding and border are included in the element's total width and height */
}

.sidebar {
    height: 100%;  /* Sets the sidebar height to cover the entire viewport height */
    width: 200px;  /* Sets the initial width of the sidebar */
    position: fixed;  /* Fixes the sidebar position relative to the viewport */
    z-index: 1;  /* Sets the stacking order of the sidebar relative to other elements */
    top: 0;  /* Positions the sidebar at the top of the viewport */
    left: 0;  /* Positions the sidebar at the left of the viewport */
    background-color: #850d2b;  /* Sets the background color of the sidebar */
    overflow-x: hidden;  /* Hides horizontal overflow content in the sidebar */
    padding-top: 60px;  /* Adds padding at the top of the sidebar */
    transition: 0.3s;  /* Smooth transition effect for sidebar animation */
}

.sidebar.active {
    width: 0;  /* Hides the sidebar when it's not active (width becomes 0) */
    padding-top: 0;  /* Removes padding from the top of the sidebar when it's not active */
}

.sidebar a {
    padding: 10px;  /* Adds padding around each sidebar link */
    text-decoration: none;  /* Removes underline from sidebar links */
    font-size: 20px;  /* Sets the font size for sidebar links */
    color: #818181;  /* Sets the text color for sidebar links */
    display: block;  /* Makes sidebar links block-level elements */
}
.profile-link {
    margin-right: 10px; /* Adjust the margin to your preference */
}

.sidebar a:hover {
    color: #f1f1f1;  /* Changes the text color of sidebar links on hover */
}

.main {
    transition: margin-left 0.3s;  /* Smooth transition effect for main content margin */
    padding: 20px;  /* Adds padding around the main content */
    margin-left: 200px;  /* Creates space on the left for the sidebar */
}

#sidebar-toggle {
    position: fixed;  /* Fixes the position of the sidebar toggle button */
    top: 20px;  /* Positions the toggle button 20px from the top */
    left: 20px;  /* Positions the toggle button 20px from the left */
    background-color: transparent;  /* Sets the background color of the toggle button to transparent */
    border: none;  /* Removes border from the toggle button */
    padding: 10px;  /* Adds padding around the toggle button */
    cursor: pointer;  /* Changes cursor to pointer on hover */
    z-index: 2;  /* Sets the stacking order of the toggle button */
}

#sidebar-toggle img {
    width: 20px;  /* Sets the width of the toggle button icon */
    height: 20px;  /* Sets the height of the toggle button icon */
    margin: 0;  /* Removes margin around the toggle button icon */
    padding: 0;  /* Removes padding around the toggle button icon */
    background-color: transparent;  /* Sets the background color of the toggle button icon to transparent */
}

@media screen and (max-width: 768px) {
    .sidebar {
        width: 0;  /* Hides the sidebar when screen width is less than or equal to 768px */
        padding-top: 0;  /* Removes padding from the top of the sidebar */
    }

    .sidebar.active {
        width: 200px;  /* Shows the sidebar when active on smaller screens */
        padding-top: 200px;  /* Adds padding to the top of the sidebar */
    }

    .main {
        margin-left: 0;  /* Removes left margin of the main content on smaller screens */
        padding: 60px;  /* Increases padding around the main content on smaller screens */
    }
}


/*POPULAR SUBJECTS*/
.cbox {
	position: relative;
	width: 100%;
	display: inline-flex;
	flex-wrap: wrap;
	justify-content: center;
}
.cbox .det {
	width: 250px;
	height: 80px;
	margin: 10px;
	background: #fff;
	cursor: pointer;
}
.cbox .det a{
	justify-content: space-around;
	width: 250px;
	padding: 28px;
	border-radius: 10px;
	border: 1px solid #FA4B37;
	font-size: 15px;
	color: #272529;
	font-family: cursive;
	text-decoration: none;
}
.cbox .det a:hover {
	background: linear-gradient(to right, #FA4B37, #DF2771);
	color: white;
}
.cbox .det a:hover img{
	filter: brightness(100);
}
.cbox img {
	width: 20px;
	margin-right: 20px;
}




    </style>
</head>
<body>
   
    
    <button id="sidebar-toggle">
        <img src="images/icon/menu.png" alt="Toggle Sidebar">
    </button>
    <div class="sidebar">
    <a href="index.php?user_id=<?php echo htmlspecialchars($_SESSION['user_id'] ?? 43); ?>" id="profile-link">
        <img src="images/icon/team.png" alt="Profile" style="width: 20px; height: 20px; margin-right: 10px;">
        Profile
    </a>
        
        <!-- Other sidebar links -->
        <a href="index.html">
            <img src="images/icon/team.png" alt="Home" style="width: 20px; height: 20px; margin-right: 10px;">
            Homepage
        </a>
        <a href="#portfolio-section">
            <img src="images/icon/portfolio.png" alt="Portfolio" style="width: 20px; height: 20px; margin-right: 10px;">
            Portfolio
        </a>
        <a href="#team-section">
            <img src="images/icon/team.png" alt="Team" style="width: 20px; height: 20px; margin-right: 10px;">
            Team
        </a>
        <a href="#services-section">
            <img src="images/icon/services.png" alt="Services" style="width: 20px; height: 20px; margin-right: 10px;">
            Services
        </a>
        <a href="#contactus-section">
            <img src="images/icon/makeitfull.png" alt="Contact" style="width: 20px; height: 20px; margin-right: 10px;">
            Contact
        </a>
        <a href="#">
            <img src="images/courses/book.png" alt="Courses" style="width: 20px; height: 20px; margin-right: 10px;">
            Courses
        </a>
        <a href="http://localhost:81/verify/Edquest-E_learning_Website(MINI%20PROJECT-2)/logout.php">
            <img src="images/icon/menu-unchecked.png" alt="Logout" style="width: 20px; height: 20px; margin-right: 10px;">
            Logout
        </a>
    </div>


    <div class="main">
        <header>
            <div class="profile-info" id="profile-info">
                <div class="profile-header">
                    <h1>User Profile</h1>
                </div>
            </div>
            <div class="title">
                <span>Courses Tailored for you</span>
                
            </div>
            <br><br>
            <div class="course">
                <center><div class="cbox">
                </div></center>
            </div>

            
            <!-- CONTACT US -->
            <div class="diffSection" id="contactus-section">
                <center><p style="font-size: 50px; padding: 100px">Contact Us</p></center>
                <div class="csec"></div>
                <div class="back-contact">
                    <div class="cc">
                    <form action="mailto:akhilteotia19@gmail.com" method="post" enctype="text/plain">
                        <label>First Name <span class="imp">*</span></label><label style="margin-left: 185px">Last Name <span class="imp">*</span></label><br>
                        <center>
                        <input type="text" name="" style="margin-right: 10px; width: 175px" required="required"><input type="text" name="lname" style="width: 175px" required="required"><br>
                        </center>
                        <label>Email <span class="imp">*</span></label><br>
                        <input type="email" name="mail" style="width: 100%" required="required"><br>
                        <label>Message <span class="imp">*</span></label><br>
                        <input type="text" name="message" style="width: 100%" required="required"><br>
                        <label>Additional Details</label><br>
                        <textarea name="addtional"></textarea><br>
                        <button type="submit" id="csubmit">Send Message</button>
                    </form>
                    </div>
                </div>
            </div>

           
    <!-- PORTFOLIO -->
    <div class="diffSection" id="portfolio_section">
        <center>
            <p style="font-size: 50px; padding: 100px; padding-bottom: 40px;">Portfolio</p>
        </center>
        <div class="content">
            <p>
                “Education is the passport to the future, for tomorrow belongs to those who prepare for it today.” “Your
                attitude, not your aptitude, will determine your altitude.” “If you think education is expensive, try
                ignorance.” “The only person who is educated is the one who has learned how to learn …and change.”
            </p>
        </div>
    </div>
    <div class="extra">
        <p>We're increasing this data every year</p>
        <div class="smbox">
            <span>
                <center>
                    <div class="data" id="total_students">Loading</div>
                    <div class="det">Enrolled Students</div>
                </center>
            </span>
            <span>
                <center>
                    <div class="data" id="total_courses">21</div>
                    <div class="det">Total Courses</div>
                </center>
            </span>
            <span>
                <center>
                    <div class="data" id="placed_students">96</div>
                    <div class="det">Placed Students</div>
                </center>
            </span>
            <span>
                <center>
                    <div class="data" id="total_projects">27</div>
                    <div class="det">Total Projects</div>
                </center>
            </span>
        </div>
    </div>

    <script>
        // Function to fetch data from server and update HTML
        function fetchDataAndUpdate() {
            // Make an AJAX request to fetch data from server
            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function () {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        var data = JSON.parse(xhr.responseText);

                        // Update the HTML with the retrieved data
                        document.getElementById('total_students').textContent = data.total_students;
                        document.getElementById('placed_students').textContent = data.total_students - 1;
                        document.getElementById('total_projects').textContent = data.total_projects;
                    } else {
                        console.error('Error fetching data from server');
                    }
                }
            };

            // Replace 'fetch.php' with your actual server-side script that fetches data from database
            xhr.open('GET', 'fetch.php', true);
            xhr.send();
        }

        // Call the function to fetch data and update HTML when the page loads
        window.onload = function () {
            fetchDataAndUpdate();
        };
    </script>



            <!-- TEAM -->
            <div class="diffSection" id="team-section">
                <center><p style="font-size: 50px; padding-top: 100px; padding-bottom: 60px;">We're the Creators</p></center>
                <div class="totalcard">
                    <div class="card">
                        <center><img src="images/creator/AKHIL_TEOTIA.jpg"></center>
                        <center><div class="card-title">Team-7</div>
                        <div id="detail">
                            <p>“ You can teach a student a lesson for a day; but if you can teach him to learn by creating curiosity, he will continue the learning process as long as he lives “</p>
                            <div class="duty"></div>
                            <a href="https://wa.me/+919535775545" target="_blank"><button class="btn-roshan">Follow +</button></a>
                        </div>
                        </center>
                    </div>
                </div>
            </div>

            <!-- SERVICES -->
            <div class="service-swipe">
                <div class="diffSection" id="services-section">
                    <center><p style="font-size: 50px; padding: 100px; padding-bottom: 40px; color: #fff;">Services</p></center>
                </div>
                <a href="subjects/computer_courses.html"><div class="s-card"><img src="images/icon/computer-courses.png"><p>Free Online Computer Courses</p></div></a>
                <a href="subjects/jee.html"><div class="s-card"><img src="images/icon/brainbooster.png"><p>Building Concepts for Competitive Exams</p></div></a>
                <a href="#"><div class="s-card"><img src="images/icon/online-tutorials.png"><p>Online Video Lectures</p></div></a>
                <a href="subjects/jee.html#sample_papers"><div class="s-card"><img src="images/icon/papers.jpg"><p>Sample Papers of Various Competitive Exams</p></div></a>
                <a href="interactive_games.html"><div class="s-card"><img src="images\games\gamepad.png"><p>Interactive games</p></div></a>
                <a href="#contactus-section"><div class="s-card"><img src="images/icon/discussion.png"><p>Discussion with Our Tutors & Mentors</p></div></a>
                <a href="subjects/quiz.html"><div class="s-card"><img src="images/icon/q1.png"><p>Daily Brain Teasing Questions to Improve IQ</p></div></a>
                <a href="#contactus-section"><div class="s-card"><img src="images/icon/help.png"><p>24x7 Online Support</p></div></a>
            </div>
        </header>
    </div>
</body>
</html>
