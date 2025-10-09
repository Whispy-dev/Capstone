<!-- latest jquery-->
<script src="{{asset('assets/js/jquery-3.6.3.min.js')}}"></script>

<!-- Bootstrap js-->
<script src="{{asset('assets/vendor/bootstrap/bootstrap.bundle.min.js')}}"></script>

<!-- Simple bar js-->
<script src="{{asset('assets/vendor/simplebar/simplebar.js')}}"></script>

<!-- phosphor js -->
<script src="{{asset('assets/vendor/phosphor/phosphor.js')}}"></script>

<!-- Customizer js-->
<script src="{{asset('assets/js/customizer.js')}}"></script>

<!-- prism js-->
<script src="{{asset('assets/vendor/prism/prism.min.js')}}"></script>

<!-- App js-->
<script src="{{asset('assets/js/script.js')}}"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


<script type="module">
  // Import the functions you need from the SDKs you need
    import { initializeApp } from "https://www.gstatic.com/firebasejs/11.0.1/firebase-app.js";
    import { getMessaging, getToken, onMessage } from "https://www.gstatic.com/firebasejs/11.0.1/firebase-messaging.js";

    
  // Your web app's Firebase configuration
  const firebaseConfig = {
    apiKey: "AIzaSyAZnitIz1LGIGxmhf07iDptOkLMwaMLR0w",
    authDomain: "cimun-chile.firebaseapp.com",
    projectId: "cimun-chile",
    storageBucket: "cimun-chile.firebasestorage.app",
    messagingSenderId: "651065637074",
    appId: "1:651065637074:web:d3efd9cabeaf1ce425550b"
  };

  // Initialize Firebase
  const app = initializeApp(firebaseConfig);

  const messaging = getMessaging(app);

  const accessToken = "TU_TOKEN_DE_AUTENTICACIÓN"; // Reemplaza con tu lógica real

  try {
    const fcmToken = await getToken(messaging, {
      vapidKey: "BIYfURImtrE1C1SVeyl-303HaNAUeoq7A9wADd3NwBZ3CY2bU6FPU23_JLFlL9DpQuCvuZteh6Jn-zyVuN2m6nc"
    });

    if (fcmToken) {
      console.log("FCM Token:", fcmToken);

        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        
        fetch('/api/device-token', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json',
            'X-CSRF-TOKEN': csrfToken
          },
          body: JSON.stringify({ token: fcmToken, user_id: {{ auth()->user()->id }}, platform: navigator.platform })
        })
        .then(res => res.json())
        .then(data => console.log('Token registrado:', data))
        .catch(err => console.error('Error al registrar token:', err));

      console.log("Token registrado correctamente en el backend");
    } else {
      console.warn("No se obtuvo token FCM");
    }
  } catch (err) {
    console.error("Error al obtener o registrar token:", err);
  }
  
  
</script>

@yield('script')
