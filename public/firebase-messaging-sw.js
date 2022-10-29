importScripts('https://www.gstatic.com/firebasejs/8.3.2/firebase-app.js');
importScripts('https://www.gstatic.com/firebasejs/8.3.2/firebase-messaging.js');

firebase.initializeApp({
    apiKey: "AIzaSyBreRvgcE1Kq2Mo8E4LSj9nEExRyGGMXW0",
    projectId: "papaj-ea7bd",
    messagingSenderId: "590651543681",
    appId: "1:590651543681:web:4e05f52d8eab32c08cfd80"
});

const messaging = firebase.messaging();
messaging.setBackgroundMessageHandler(function({ data: { title, body, icon } }) {
    return self.registration.showNotification(title, { body, icon });
});