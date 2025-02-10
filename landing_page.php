<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Landing Page</title>
    <link rel="stylesheet" href="styles.css"> <!-- Add your CSS file -->
    <style>
        /* Container for the background image */
        .c-bg {
            position: relative;
            width: 100vw; /* Full width of the viewport */
            height: 100vh; /* Full height of the viewport */
        }

        /* Style for the image inside the container */
        .c-bg img {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%; /* Scale the image to the width of the container */
            height: 100%; /* Scale the image to the height of the container */
            object-fit: cover; /* Ensures the image covers the area without distortion */
            animation: animcolor 5s linear infinite; /* Apply the animation to rotate the hue */
        }

        /* Animation for hue rotation */
        @keyframes animcolor {
            100% {
                filter: hue-rotate(360deg);
            }
        }

        /* Additional styles */
        body {
            font-family: 'Arial', sans-serif; /* Set default font */
            margin: 0;
            padding: 0;
            color: #fff;
        }

        .container {
            text-align: left;
            padding: 50px;
            position: absolute;
            top: 50%; /* Position it vertically in the center */
            left: 50%;
            transform: translate(-50%, -50%); /* Center the container */
            z-index: 2; /* Make sure it's above the image */
            width: 1000px;
            
        }

        h1 {
            text-align: center;
            font-size: 3rem; /* Set font size for the header */
            font-weight: bold;
            margin-bottom: 20px;
        }

        .user-info {
            margin: 20px auto;
            padding: 25px;
            background: rgba(0, 0, 0, 0.4); /* Semi-transparent background for readability */
            border-radius: 15px;
            width: 50%;
            z-index: 2; /* Ensure the user info is above the background */
            font-family: 'Arial', sans-serif;
            
            
        }

        .user-info h2 {
            font-size: 2rem;
            margin-bottom: 15px;
        }

        .user-info p {
            font-size: 1.2rem;
            line-height: 1.8; /* Adjust line spacing */
            margin-bottom: 15px; /* Space between data fields */
        }

        .user-info strong {
            color:rgb(255, 255, 255); /* Highlight the labels with a gold color */
            font-weight: bold;
        }

        /* Responsive design adjustments */
        @media (max-width: 768px) {
            .user-info {
                width: 80%; /* Adjust width on smaller screens */
            }

            h1 {
                font-size: 2.5rem; /* Adjust font size for smaller screens */
            }

            .user-info h2 {
                font-size: 1.5rem; /* Adjust subtitle font size for smaller screens */
            }
        }
    </style>
</head>
<body>
<div class="c-bg">
    <img src="3d-rendering-hexagonal-texture-background.jpg" alt="Christmas Background">
    <button onclick="logout()" 
        style="
            position: absolute; 
            top: 20px; 
            right: 20px; 
            padding: 10px 15px; 
            background: #ff4b5c; 
            color: white; 
            border: none; 
            border-radius: 5px; 
            cursor: pointer; 
            font-size: 14px; 
            z-index: 10;">
        Logout
    </button>
    <div class="container">
        <h1>Welcome...!</h1>
        <div class="user-info">
            <h2 style="text-align: center;">Your Details:</h2>
            <p id="details"></p>
        </div>
    </div>
</div>

<script>
    const urlParams = new URLSearchParams(window.location.search);
    const email = urlParams.get('email');

    // Fetch user details based on email
    fetch('get_user_details.php?email=' + encodeURIComponent(email))
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                const details = `
                    <strong>Name:</strong> ${data.firstname} ${data.lastname}<br>
                    <strong>Email:</strong> ${data.email}<br>
                    <strong>Phone:</strong> ${data.phone}<br>
                    <strong>Address:</strong> ${data.address}<br>
                    <strong>Date of Birth:</strong> ${data.dob}<br>
                    <strong>Gender:</strong> ${data.gender}
                `;
                document.getElementById('details').innerHTML = details;
            } else {
                document.getElementById('details').innerText = 'Unable to fetch user details.';
            }
        })
        .catch(error => {
            console.error('Error fetching user details:', error);
            document.getElementById('details').innerText = 'An error occurred.';
        });
        function logout() {
        alert('You have been logged out.');
        window.location.href = 'login.html';
    }
</script>
</body>
</html>
