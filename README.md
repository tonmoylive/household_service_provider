# household_service_provider



## SHEBA - A Household Service Provider 🏠
[![Stars](https://img.shields.io/github/stars/tonmoylive/household_service_provider?style=social)]()
[![Forks](https://img.shields.io/github/forks/tonmoylive/household_service_provider?style=social)]()



## Description
SHEBA is a web-based platform designed to connect users with household service providers. It offers a range of services, including electrician, plumbing, cleaning, carpentry, painting, AC/appliance repair, and more. The system includes admin, technician and requester (customer) portals. Key features include service request submission, work order assignment, user management, and reporting. This project is primarily built with PHP, JavaScript, and utilizes frameworks such as Laravel and Bootstrap.



## Table of Contents
- [Description](#description)
- [Features](#features)
- [Tech Stack](#tech-stack)
- [Installation](#installation)
- [Usage](#usage)
- [Project Structure](#project-structure)
- [Contributing](#contributing)
- [License](#license)
- [Important Links](#important-links)
- [Fork it](#fork-it)



## Features ✨
- **Service Request Submission:** Customers can submit service requests via a web form, specifying the type of service needed, a description of the issue, and their contact information. 📝
- **Admin Panel:** Administrators can manage service requests, assign work orders to technicians, manage user accounts, and generate work reports. ⚙️
- **Technician Management:** Administrators can add, edit, and delete technician profiles, including their name, city, mobile number, and occupation. 🧑‍🔧
- **Customer (Requester) Management:** Administrators can manage customer accounts, including adding, editing, and deleting accounts. 👤
- **Work Order Assignment:** Administrators can assign service requests to available technicians, including scheduling the date and time of the service. 🛠️
- **Email Notifications:** The system can send email notifications to customers upon service assignment, providing details about the assigned technician and schedule. 📧
- **Session Management**: The application uses session management to handle user authentication and authorization
- **Password Management**: Includes forgot password and password reset functionality.



## Tech Stack 💻
- **Primary Language:** PHP
- **Frontend:** HTML, CSS, JavaScript, Bootstrap
- **Backend:** PHP, Laravel
- **Database:** MySQL (Assumed based on common PHP usage and `dbConnection.php`)
- **Email Functionality:** PHPMailer
- **Frameworks/Libraries:**
    - TypeScript
    - Bootstrap
    - Python
    - Next.js
    - Angular
    - Node.js
    - Tailwind
    - React
    - Vue
    - Flask
    - Laravel
    - Express



## Installation ⚙️
1.  **Clone the repository:**
   ```bash
   git clone https://github.com/tonmoylive/household_service_provider.git
   cd household_service_provider
   ```

2.  **Database Configuration:**
    - Create a MySQL database named `sheba_db`.
    - Update the database connection details in `dbConnection.php`:
      ```php
      <?php
      $db_host = "localhost";
      $db_user = "root";
      $db_password = "";
      $db_name = "sheba_db";

      // Create Connection
      $conn = new mysqli($db_host, $db_user, $db_password, $db_name);

      // Check Connection
      if($conn->connect_error) {
       die("connection failed");
      }
      ?>
      ```

3. **Import SQL dump:**
   - Import the `sheba_db.sql` file into your MySQL database to create the necessary tables.

4.  **PHPMailer Setup:**
    - Configure PHPMailer with your Gmail credentials (or other SMTP server) in `Admin/assignworkform.php` and `Requester/forgot_password.php`
     -  Enable “less secure app access” in your Gmail account or configure an App Password for enhanced security.

    ```php
    $mail = new PHPMailer(true);
    try {
      $mail->isSMTP();
      $mail->Host = 'smtp.gmail.com';
      $mail->SMTPAuth = true;
      $mail->Username = 'abc@gmail.com'; // your Gmail
      $mail->Password = '';   // your Gmail App Password
      $mail->SMTPSecure = 'tls';
      $mail->Port = 587;

      $mail->setFrom('abc@gmail.com', 'SHEBA');
      $mail->addAddress($remail, $rname);
    ```

5.  **Web Server Configuration:**
    - Configure your web server (e.g., Apache, Nginx) to point to the project's root directory.
    - Ensure PHP is enabled and properly configured.



## Usage 💡
1.  **Accessing the Application:**
    - Open your web browser and navigate to the project URL.

2.  **Admin Login:**
    - Access the admin portal by navigating to `Admin/login.php`.
    - Use the admin credentials to log in and manage the system.

3.  **Customer Registration and Login:**
    - New customers can register through the registration form on the homepage.
    - Existing customers can log in via `Requester/RequesterLogin.php`.
    - After registration ,email verification is required to login.

4.  **Submitting a Service Request (Customer):**
    - Log in to the customer portal.
    - Navigate to the "Submit Request" page (`Requester/SubmitRequest.php`).
    - Fill out the service request form and submit.

5.  **Assigning Work (Admin):**
    - In the admin panel, navigate to the "Requests" page (`Admin/request.php`).
    - View a service request and assign it to a technician using the "Assign" form.
 
6. **Password recovery**:
   - In the customer login, user can recover the password through registered email address



## Project Structure 📂
```
household_service_provider/
├── Admin/                      # Admin Panel files
│   ├── assignworkform.php    # Assign work form
│   ├── changepass.php        # Admin change password page
│   ├── dashboard.php         # Admin dashboard
│   ├── editemp.php           # Edit technician page
│   ├── editreq.php           # Edit requester page
│   ├── includes/            # Admin includes (header, footer)
│   ├── insertemp.php         # Insert new technician page
│   ├── insertreq.php         # Insert new requester page
│   ├── login.php             # Admin login page
│   ├── request.php           # Request management page
│   ├── requester.php         # Requester management page
│   ├── technician.php        # Technician management page
│   ├── viewassignwork.php    # View assigned work details
│   └── work.php              # Work order management page
├── Requester/                  # Requester (Customer) Panel files
│   ├── CheckStatus.php       # Check service status page
│   ├── RequesterLogin.php    # Requester login page
│   ├── RequesterProfile.php  # Requester profile page
│   ├── Requesterchangepass.php # Requester change password page
│   ├── SubmitRequest.php     # Submit service request page
│   ├── get_assigned_details.php # Fetches service details via AJAX
│   └── includes/             # Requester includes (header, footer)
├── css/                      # CSS stylesheets
├── images/                   # Image assets
├── js/                       # JavaScript files
├── src/                      #PHPMailer files
├── contactform.php           # Contact form processing
├── dbConnection.php         # Database connection file
├── index.php                 # Main landing page
└── logout.php                # Logout script
```



## API Reference 📚
- The project doesn't appear to have a well-defined API based on code analysis. However, `Requester/get_assigned_details.php` serves as an API endpoint:
  - **Endpoint:** `Requester/get_assigned_details.php`
  - **Method:** POST
  - **Parameters:**
    - `request_id`:  The ID of the service request to retrieve details for.
  - **Response:**
    - Returns HTML content containing the assigned service details.



## Contributing 🤝
Contributions are welcome! Please follow these steps:

1.  Fork the repository. 🍴
2.  Create a new branch for your feature or bug fix. 🌳
3.  Implement your changes and test thoroughly. ✅
4.  Submit a pull request with a clear description of your changes. 🚀



## License 📜
This project has no license.



## Important Links 🔗
- **Repository Link:** [https://github.com/tonmoylive/household_service_provider](https://github.com/tonmoylive/household_service_provider)



## Fork it 🍴
If you find this project helpful, consider forking it to explore and implement your own improvements.
Also, feel free to contribute, suggest improvements, report bugs, request features.

<footer>
  <p>© 2025 <a href="https://github.com/tonmoylive/household_service_provider">household_service_provider</a> by <a href="https://mdanikbiswas.rf.gd/">MD ANIK BISWAS</a></p>
  <p> Feel free to contribute ,report bugs , request features, like and give a star ⭐ to this repository. </p>
</footer>
