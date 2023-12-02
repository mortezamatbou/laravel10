<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>@yield('title')</title>
    <style>
        * {
            font-size: 14px;
        }
    </style>
</head>
<body>


<div class="container">

    <div class="row p-5">

        <div class="col-12">
            <ul>
                @section('menu')
                    <li><a href="{{ route('slack.index') }}">Home</a></li>
                @show
            </ul>
            <hr>
        </div>
        <div class="col-12">
            @yield('body')
        </div>

    </div>


</div>


<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
        crossorigin="anonymous"></script>

<script type="module">
    // Import the functions you need from the SDKs you need
    import {initializeApp} from "https://www.gstatic.com/firebasejs/10.7.0/firebase-app.js";
    import {getAnalytics} from "https://www.gstatic.com/firebasejs/10.7.0/firebase-analytics.js";
    import {getMessaging, getToken, onMessage} from "https://www.gstatic.com/firebasejs/10.7.0/firebase-messaging.js";
    // TODO: Add SDKs for Firebase products that you want to use
    // https://firebase.google.com/docs/web/setup#available-libraries

    // Your web app's Firebase configuration
    // For Firebase JS SDK v7.20.0 and later, measurementId is optional
    const firebaseConfig = {
        apiKey: "AIzaSyDkn2sb2PW-vOWU_b39pdLzn2GPg-I8SZc",
        authDomain: "fcm-test-eb819.firebaseapp.com",
        projectId: "fcm-test-eb819",
        storageBucket: "fcm-test-eb819.appspot.com",
        messagingSenderId: "659587850429",
        appId: "1:659587850429:web:d696ab9e3dfc5911a757d4",
        measurementId: "G-G44QM0PVXY"
    };

    // Initialize Firebase
    const app = initializeApp(firebaseConfig);
    const analytics = getAnalytics(app);

    // Initialize Firebase Cloud Messaging and get a reference to the service
    const messaging = getMessaging(app);
    // getToken(messaging, {vapidKey: "BPwlPIUS31ScDWF0olv5nsqj27DptccbJHRTvbtuNiaxsLZeUCRtTVytSzKEZixZdV9-Kf09CJdE3sMJAR_IJPQ"});

    getToken(messaging, {vapidKey: 'BPwlPIUS31ScDWF0olv5nsqj27DptccbJHRTvbtuNiaxsLZeUCRtTVytSzKEZixZdV9-Kf09CJdE3sMJAR_IJPQ'}).then((currentToken) => {
        if (currentToken) {
            // Send the token to your server and update the UI if necessary
            // ...
            console.log('OKKK');
        } else {
            // Show permission request UI
            console.log('No registration token available. Request permission to generate one.');
            // ...
        }
    }).catch((err) => {
        console.log('An error occurred while retrieving token. ', err);
        // ...
    });
    onMessage(messaging, (payload) => {
        console.log('Message received. ', payload);
        // ...
    });


</script>

</body>
</html>
