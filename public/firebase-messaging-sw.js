importScripts('https://www.gstatic.com/firebasejs/7.5.0/firebase-app.js');
importScripts('https://www.gstatic.com/firebasejs/7.5.0/firebase-messaging.js');

firebase.initializeApp({
    apiKey: "AIzaSyBMKejqPBDFyiL-hvMjx1CXOJwNgfUDLEE",
    authDomain: "fcm-testing-3e3ff.firebaseapp.com",
    databaseURL: "https://fcm-testing-3e3ff.firebaseio.com",
    projectId: "fcm-testing-3e3ff",
    storageBucket: "fcm-testing-3e3ff.appspot.com",
    messagingSenderId: "626397484394",
    appId: "1:626397484394:web:dc28075f611c225516c113"
});

const messaging = firebase.messaging();

messaging.setBackgroundMessageHandler(function(payload) {
    console.log('[firebase-messaging-sw.js] Received background message ', payload);
    const notificationTitle = '>> ';
    const notificationOptions = {
        body: payload.notification.body,
    };

    return self.registration.showNotification(
        notificationTitle,
        notificationOptions
    );
});
