import firebase from 'firebase/app';
import 'firebase/messaging';

var firebaseConfig = {
    apiKey: "AIzaSyBMKejqPBDFyiL-hvMjx1CXOJwNgfUDLEE",
    authDomain: "fcm-testing-3e3ff.firebaseapp.com",
    databaseURL: "https://fcm-testing-3e3ff.firebaseio.com",
    projectId: "fcm-testing-3e3ff",
    storageBucket: "fcm-testing-3e3ff.appspot.com",
    messagingSenderId: "626397484394",
    appId: "1:626397484394:web:dc28075f611c225516c113"
};

firebase.initializeApp(firebaseConfig);

// Get Message Service
const messaging = firebase.messaging();
messaging.usePublicVapidKey('BPpd6qxQHYVZUrhKyskYdxEtpDLK_UtelZXAMLfKPPXJFCtcjpK9FAlexQpyO4L4LtzFIdQwiYVQlENIFQKe01M');

navigator.serviceWorker.register('/firebase-messaging-sw.js')
    .then((registration) => {
        registration.update();

        messaging.useServiceWorker(registration);
    });

messaging.requestPermission()
    .then(() => messaging.getToken())
    .then(token => saveToken(token));

messaging.onMessage(({ notification, data }) => {
    console.log(notification, data);
    appendMessage(data);
    let notif = new Notification(notification.title, {
        icon: 'http://cdn.sstatic.net/stackexchange/img/logos/so/so-icon.png',
        body: notification.body,
    });
    notif.onclick = function () {
        window.open('https://google.com', '_blank');
    };
});

messaging.onTokenRefresh(function () {
    messaging.getToken().then(function (refreshedToken) {
        saveToken(refreshedToken);
    }).catch(function (err) {
        console.log('Unable to retrieve refreshed token ', err);
    });
});

// Server Side
function appendMessage ({ user, message }) {
    const content = `
        <div class="message__wrapper">
            <span class="message__title">${user}</span>
            <span class="message__content">${message}</span>
        </div>
    `;

    $('#messages').append(content);
    $('#messages').scrollTop($('#messages')[0].scrollHeight);

    $('#message').val('').focus();
}
function saveToken(token) {
    const user = $('#name').val();

    axios.post('save-token', {
        user,
        token,
    });
}

function sendMessage() {
    const message = $('#message').val();

    axios.post('send-message', { message });
}

$('#send').on('click', function (e) {
    e.preventDefault();

    sendMessage()
});
