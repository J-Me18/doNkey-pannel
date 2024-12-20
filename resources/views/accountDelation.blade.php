<!DOCTYPE html>
<html lang="en">

<head>
    
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        h3 {
            margin-top: 15px;
        }

        h4 {
            margin-left: 30px;
        }

        li {
            margin-left: 60px;
        }

        p {
            margin-bottom: 10px;
        }

        ul {
            margin-bottom: 10px;
        }

        .contact-link {
            color: #007bff;
            text-decoration: none;
        }

        header {
            background-color: #d3ff53;
            color: black;
            padding: 10px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        header h1 {
            margin: 0;
        }

        nav {
            display: flex;
            gap: 20px;
        }

        nav a {
            color: white;
            text-decoration: none;
        }

        main {
            margin: 20px;
            padding-bottom: 50px;
        }

        footer {
            background-color:#d3ff53;
            color: black;
            text-align: center;
            padding: 10px;
            position: fixed;
            bottom: 0;
            width: 100%;
            margin-top: 20px;
        }

        @media only screen and (max-width: 768px) {
            nav {
                display: none;
                flex-direction: column;
                position: absolute;
                top: 60px;
                left: 0;
                background-color: #333;
                width: 100%;
                padding: 10px;
            }

            nav.show {
                display: flex;
            }

            nav a {
                display: block;
                margin-bottom: 10px;
            }

            .hamburger {
                display: block;
                cursor: pointer;
                order: -1;
            }
        }
    </style>
</head>

<body>

    <header>
        {{-- <div class="hamburger">&#9776;</div> --}}
        <h1>do N key</h1>
        {{-- <nav>
            <a href="#">Home</a>
            <a href="#">About</a>
            <a href="#">Contact</a>
        </nav> --}}
    </header>

    {{-- <nav>
        <a href="#">Home</a>
        <a href="#">About</a>
        <a href="#">Contact</a>
    </nav> --}}

    <main>
        <div class="card" style="border: none">
            <h3 style="text-align: center">Account Deletion Privacy Policy</h3>

            <p>Last Updated: 01/12/2023</p>

            <p style="margin-left: 15px;">We respect your privacy and are committed to providing a straightforward process for account deletion. This Privacy Policy outlines the procedures and considerations when you request the deletion of your account from do N key.</p>

            <h3>1. Requesting Account Deletion:</h3>

            <h4>1.1. Submission:</h4>
            <ul>
                <li>Account deletion requests should be submitted via email to <a href="mailto:support@donkeydeliveries.com">support@donkeydeliveries.com</a> from the email address associated with the account.</li>
            </ul>

            <h4>1.2. Verification:</h4>
            <ul>
                <li>For security reasons, we may request additional verification to ensure the legitimacy of the account deletion request.</li>
            </ul>

            <h3>2. Processing Account Deletion:</h3>

            <h4>2.1. Timeline:</h4>
            <ul>
                <li>We will process the account deletion request within 1 business days upon successful verification.</li>
            </ul>

            <h4>2.2. Irreversible Process:</h4>
            <ul>
                <li>Once the account is deleted, it is irreversible, and all associated data will be permanently removed from our system.</li>
            </ul>

            <h3>3. Retention of Certain Information:</h3>

            <h4>3.1. Legal Obligations:</h4>
            <ul>
                <li>We may retain certain information as required by law or for legitimate business purposes, such as transaction records.</li>
            </ul>

            <h3>4. Confirmation Email:</h3>

            <h4>4.1. Notification:</h4>
            <ul>
                <li>Upon successful account deletion, a confirmation email will be sent to the email address provided in the account deletion request.</li>
            </ul>

            <h3>5. Communication:</h3>

            <h4>5.1. Updates:</h4>
            <ul>
                <li>We may communicate with you during the account deletion process to address any concerns or provide necessary information.</li>
            </ul>

            <h3>6. Deletion of Personal Information:</h3>

            <h4>6.1. Data Removal:</h4>
            <ul>
                <li>All personal information associated with the deleted account, including but not limited to personal details, transaction history, and preferences, will be permanently removed.</li>
            </ul>

            <h3>7. Contact Information:</h3>

            <h4>7.1. Inquiries:</h4>
            <ul>
                <li>For questions or concerns related to account deletion, you can contact us at <a href="mailto:support@donkeydeliveries.com">support@donkeydeliveries.com</a>.</li>
            </ul>

            <p>By submitting an account deletion request, you acknowledge and agree to the terms outlined in this Privacy Policy. We reserve the right to update this policy as necessary, and any changes will be communicated to you via email or through our platform.</p>


        </div>
    </main>

    <footer>
        &copy; <?php echo date('Y'); ?> do N key
    </footer>

    {{-- <script>
        // Toggle mobile navigation on hamburger click
        document.querySelector('.hamburger').addEventListener('click', function() {
            document.querySelector('nav').classList.toggle('show');
        });
    </script> --}}

</body>

</html>
