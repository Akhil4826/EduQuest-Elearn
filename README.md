# 🌟 **EdQuest-Elearn** 🌟  
🎓 **An Educational Platform for Students and Programmers** 👨‍💻👩‍💻

---

## 🌐 **Table of Contents**
1. [✨ Introduction](#introduction)
2. [🚨 Problem Statement](#problem-statement)
3. [💡 Proposed Solution](#proposed-solution)
4. [📋 Requirements Specification](#requirements-specification)
5. [🚀 Features of EdQuest](#features-of-edquest)
6. [🗂️ Contents](#contents)
7. [🛠️ Setup and Installation](#setup-and-installation)

---

## 1. ✨ **Introduction** <a name="introduction"></a>
**EdQuest** is a next-generation educational platform designed to **bridge the gap** between **theoretical learning** and **practical programming** skills. With the rapid advancement of technology, it brings together **academic subjects** and **hands-on coding practice** under one roof, providing an engaging, **personalized learning experience** for students and programmers alike! 🌱🎯

---

## 2. 🚨 **Problem Statement** <a name="problem-statement"></a>
Existing educational platforms often focus on **either academic subjects** or **programming skills**, missing out on offering a **balanced learning experience**. Most platforms are **not personalized** and fail to cater to the diverse needs of students.

### 🎯 **Key Challenges**:
- **Lack of Integration** between academic subjects and practical programming.
- **One-size-fits-all Approach** that doesn't address individual learning needs.
- **Limited Personalization** and adaptive learning paths.

---

## 3. 💡 **Proposed Solution** <a name="proposed-solution"></a>
**EdQuest** solves these problems by offering a **holistic educational platform** that seamlessly blends **academics** with **programming practice**.

### 🔑 **Key Features**:
- **🎯 Personalized Learning Paths** tailored to your progress.
- **🛠️ Interactive Tutorials** with hands-on coding exercises.
- **👥 Community Engagement** for peer-to-peer support.
- **📊 Advanced Analytics** to track your progress and offer real-time feedback.

---

## 4. 📋 **Requirements Specification** <a name="requirements-specification"></a>

### 🔧 **Functional Requirements**:
- **🔐 User Authentication**: Secure login via email or social media.
- **👤 Profile Management**: Manage your learning preferences and goals.
- **📚 Course Catalog**: Searchable and filterable course lists.
- **🎥 Content Delivery**: Support for video lectures, articles, and coding environments.
- **📈 Progress Tracking**: Monitor user progress through lessons, assignments, and quizzes.
- **💻 Assessment & Feedback**: Real-time quizzes and exams with instant feedback.

### 🖥️ **Software Requirements**:
- **OS**: Windows 11 or higher
- **Development Tools**: Visual Studio Code (HTML, CSS, JS, PHP)
- **Backend**: MySQL, PHP
- **Packages**: PHPMailer, Twilio

---

## 5. 🚀 **Features of EdQuest** <a name="features-of-edquest"></a>
- **🎮 Interactive Games**: Make learning fun through gamified exercises!
- **🧠 Quizzes**: Real-time quizzes to test your knowledge on various subjects.
- **⚡ Error Hinting System**: Learn from mistakes and improve coding skills.
- **📚 Course Materials**: Access comprehensive learning materials and study resources.
- **🤝 Collaborative Projects**: Work together on coding challenges and solve real-world problems.

---

## 6. 🗂️ **Contents** <a name="contents"></a>
- **🏠 Welcome Page**: User-friendly homepage introducing the platform.
- **🔑 Login Page**: Secure multi-user access for personalized learning.
- **📝 Register Section**: Easy and quick user registration process.
- **📊 Profile Page**: Track your learning goals with a personalized dashboard.
- **🤖 Educational Chatbot**: Get assistance and guidance on platform navigation.
- **📚 Courses and Services**: A wide range of services, including coding courses, quizzes, and study materials.

---

## 7. 🛠️ **Setup and Installation** <a name="setup-and-installation"></a>

Follow these steps to set up **EdQuest** on your local machine using **XAMPP** or any equivalent server. 🌐

### 💻 **Steps**:

1. **Install XAMPP** (or any equivalent server software):
   - Download XAMPP from [here](https://www.apachefriends.org/index.html).
   - Install and make sure both **Apache** and **MySQL** services are running.

2. **Clone the Repository**:
   - Open a terminal and run the following command to clone the project repository:
     ```bash
     git clone https://github.com/yourusername/edquest-elearn.git
     ```

3. **Move to the Project Directory**:
   - Navigate to the project folder:
     ```bash
     cd edquest-elearn
     ```

4. **Configure the Database**:
   - Import the provided **SQL file** into **MySQL** to create the necessary tables:
     1. Open **phpMyAdmin** (usually accessible at `http://localhost/phpmyadmin`).
     2. Create a new database (e.g., `edquest_db`).
     3. Import the SQL file (`edquest.sql`) into the newly created database.
   - **Update Database Credentials** in the PHP configuration files (`config.php`) with your MySQL credentials:
     ```php
     $servername = "localhost";
     $username = "your-mysql-username";
     $password = "your-mysql-password";
     $dbname = "edquest_db";
     ```

5. **Start the XAMPP Server**:
   - Make sure **Apache** and **MySQL** services are running in XAMPP:
     1. Open **XAMPP Control Panel**.
     2. Start both the **Apache** and **MySQL** modules.

6. **Access the Application**:
   - Open your browser and navigate to:
     ```
     http://localhost:8081
     ```
   - You can now start using **EdQuest** to explore interactive learning, track your progress, and engage with the platform! 🎓🎉

---

### 🎉 **Start Your Learning Journey with EdQuest!**

Explore **interactive learning**, **track your progress**, collaborate with **peers**, and build your **skills** with the most comprehensive educational platform for students and programmers alike! 🌟🎓

---

## 📸 **Screenshots of EdQuest Platform**

Below are some screenshots showcasing various sections and features of the **EdQuest-Elearn** platform:

---

### 🤖 **Welcome Page**

![Screenshot 2024-10-07 172327](https://github.com/user-attachments/assets/620506f3-66ed-437f-b2dc-d8e533807baa)



- The **Welcome Page** introduces users to the platform and offers easy navigation to explore the platform’s features and services.

---

### 🔑 **Login Page**

![Screenshot (279)](https://github.com/user-attachments/assets/5658ad20-2b75-4d83-b45c-b7fa67c843f8)

- Use the **Login Page** to access your account and unlock premium features, including access to the platform’s chatbot for assistance.

---


### 📚 **Courses Page**

![Screenshot 2024-10-07 172246](https://github.com/user-attachments/assets/dc465dbf-557f-4369-9e38-cb06604f3e3b)

- The **Courses Page** offers a wide range of academic subjects and programming tutorials.
- Users can filter courses by topics or difficulty levels and start learning right away with interactive tutorials.

---
![Screenshot (281)](https://github.com/user-attachments/assets/c7ae95df-55c2-4fd6-bf87-48d24dba511f)

### 📊 **Profile Page**

![Screenshot (281)](https://github.com/user-attachments/assets/c7ae95df-55c2-4fd6-bf87-48d24dba511f)

- The **Profile Page** helps users track their learning journey with the **Progress Tracking Dashboard**.
- Monitor your completed courses, upcoming assignments, and overall performance at a glance.

---

These screenshots illustrate the power of **EdQuest** in providing a dynamic, user-friendly, and interactive learning experience. 🌟
