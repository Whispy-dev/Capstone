// firebase-messaging-sw.js
importScripts("https://www.gstatic.com/firebasejs/8.3.2/firebase-app.js");
importScripts("https://www.gstatic.com/firebasejs/8.3.2/firebase-messaging.js");

firebase.initializeApp({
    apiKey: "AIzaSyAZnitIz1LGIGxmhf07iDptOkLMwaMLR0w",
    authDomain: "cimun-chile.firebaseapp.com",
    projectId: "cimun-chile",
    storageBucket: "cimun-chile.firebasestorage.app",
    messagingSenderId: "651065637074",
    appId: "1:651065637074:web:d3efd9cabeaf1ce425550b"
});

const messaging = firebase.messaging();


// ✅ Nueva forma de manejar mensajes en segundo plano
messaging.onBackgroundMessage(function(payload) {
  console.log('[firebase-messaging-sw.js] Mensaje recibido en segundo plano:', payload);

  const notificationTitle = payload.notification?.title || 'Notificación';
  const notificationOptions = {
    body: payload.notification?.body || '',
    icon: 'https://www.cimun.cl/assets/images/logo/LOGOCIMUN.png',
    data: payload.data
  };

  self.registration.showNotification(notificationTitle, notificationOptions);
});
