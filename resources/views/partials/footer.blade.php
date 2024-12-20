<style>
    .floatchat {

        /* position: absolute; */
        position: fixed;
        padding: 10px;
        border-radius: 20px;
        background-color: #1b68ff;
        bottom: 10px;
        right: 40px;
        z-index: 22;


    }

    .floatchat i {
        color: white;
        font-size: 30px;
    }

    .floatdot {
        position: absolute;
        width: 15px;
        height: 15px;
        background-color: red;
        right: 0px;
        border-radius: 10px;
        margin-top: -15px;
    }
</style>
<div class="floatchat sticky-bottom">
    <div class="floatdot dotadmin1" hidden></div>
    <a href="{{ route('chatwithadmin') }}">
        <i class="fe fe-message-circle fe-16"></i>
    </a>

</div>

<script type="module">
    import {
        initializeApp
    } from "https://www.gstatic.com/firebasejs/9.20.0/firebase-app.js";
    import {
        getAnalytics
    } from "https://www.gstatic.com/firebasejs/9.20.0/firebase-analytics.js";

    import {
        getDatabase,
        set,
        ref,
        push,
        child,
        onValue,
        onChildAdded
    } from "https://www.gstatic.com/firebasejs/9.20.0/firebase-database.js";
    // TODO: Add SDKs for Firebase products that you want to use
    // https://firebase.google.com/docs/web/setup#available-libraries

    // Your web app's Firebase configuration
    // For Firebase JS SDK v7.20.0 and later, measurementId is optional
    const firebaseConfig = {
        apiKey: "AIzaSyCjF2n53vtKKaWyPLJURHCr8hPVjqzGKg8",
        authDomain: "donkey-18b12.firebaseapp.com",
        projectId: "donkey-18b12",
        storageBucket: "donkey-18b12.appspot.com",
        messagingSenderId: "1025418662407",
        appId: "1:1025418662407:web:947f0f8e534af293b8d0a2",
        measurementId: "G-MXHJ3J1FHF"
    };

    // Initialize Firebase
    const app = initializeApp(firebaseConfig);
    const analytics = getAnalytics(app);
    const database = getDatabase(app);
    setInterval(() => {

        var $valcount = 0;
        var $valcount1 = 0;
        var $vo = 0;
        var $vall = 0;
        const newmsg = ref(database, 'messageswithadmin/');

        <?php 
$value = \App\Models\Subscriber::get('subscriberId');
foreach($value as $v){
?>
        $(".dot{{ $v->subscriberId }}").css("background", "red !important");
        // console.log('{{ $v->subscriberId }}');
        onChildAdded(newmsg, (data) => {


            if ("admin->{{ $v->subscriberId }}" == data.val().name || "{{ $v->subscriberId }}->admin" ==
                data.val().name) {
                $valcount = $valcount + 1;

            }
            // $valcount1=$valcount1+1;

        });
        $vall = localStorage.getItem("countmessagesubadmin{{ $v->subscriberId }}");

        if ($vall < $valcount) {
            $(".dot{{ $v->subscriberId }}").css("color", "red");
            // $(".dot{{ $v->subscriberId }}").css("display", "block");
            $(".dot{{ $v->subscriberId }}").removeAttr('hidden');
            //     console.log($vall);
            // console.log($valcount);
            $vo = 1;
            $(".dotadminsupport").css("color", "red");
            // $(".dotadminsupport").css("display", "block");
            $(".dotadminsupport").removeAttr('hidden');
        }
        $valcount = 0;
        $vall = 0;
        <?php }?>
        // console.log($vall);
        // if ($vall == countdata.length) {
        //     console.log('hai');
        // } else {
        // console.log('hai1');
        // }    
    }, 500);
    // Import the functions you need from the SDKs you need
</script>


<script type="module">
    import {
        initializeApp
    } from "https://www.gstatic.com/firebasejs/9.20.0/firebase-app.js";
    import {
        getAnalytics
    } from "https://www.gstatic.com/firebasejs/9.20.0/firebase-analytics.js";

    import {
        getDatabase,
        set,
        ref,
        push,
        child,
        onValue,
        onChildAdded
    } from "https://www.gstatic.com/firebasejs/9.20.0/firebase-database.js";
    // TODO: Add SDKs for Firebase products that you want to use
    // https://firebase.google.com/docs/web/setup#available-libraries

    // Your web app's Firebase configuration
    // For Firebase JS SDK v7.20.0 and later, measurementId is optional
    const firebaseConfig = {
        apiKey: "AIzaSyCjF2n53vtKKaWyPLJURHCr8hPVjqzGKg8",
        authDomain: "donkey-18b12.firebaseapp.com",
        projectId: "donkey-18b12",
        storageBucket: "donkey-18b12.appspot.com",
        messagingSenderId: "1025418662407",
        appId: "1:1025418662407:web:947f0f8e534af293b8d0a2",
        measurementId: "G-MXHJ3J1FHF"
    };

    @if (isset($v))
        // Initialize Firebase
        const app = initializeApp(firebaseConfig);
        const analytics = getAnalytics(app);
        const database = getDatabase(app);
        setInterval(() => {
            var $valcount1 = 0;
            var $vall2 = 0;
            const newmsg = ref(database, 'messages/');

            onChildAdded(newmsg, (data) => {
                $valcount1 = $valcount1 + 1;
            });

            $vall2 = localStorage.getItem("countmessagewithadmins");

            if ($vall2 < $valcount1) {
                $(".dotadmin").css("color", "red");
                $(".dotadmin1").css("background-color", "red");
                $(".dotadmin1").css("background-color", "red");
                $(".dotadmin").removeAttr('hidden');
                $(".dotadmin1").removeAttr('hidden');
            }
        }, 500);
    @else
        {{-- Display an empty block --}}
    @endif
</script>
