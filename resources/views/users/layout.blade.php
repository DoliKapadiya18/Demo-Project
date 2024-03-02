<!DOCTYPE html>
<html>
<head>
    <title>Client Management System</title>
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"> -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.min.css" rel="stylesheet">
    
    <link href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.4.2/css/fontawesome.min.css" rel="stylesheet">
    
    <link href="https://cdn.datatables.net/1.11.4/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-date-range-picker/0.21.1/daterangepicker.css"/>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/js/all.min.js" integrity="sha512-GWzVrcGlo0TxTRvz9ttioyYJ+Wwk9Ck0G81D+eO63BaqHaJ3YZX9wuqjwgfcV/MrB2PhaVX9DkYVhbFpStnqpQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    

</head>
<body>
    
<div class="container">
    @yield('content')
</div>

@stack('script')

<script>
        //console.log('1');
        // function copyToClipboard() {

        //     alert($(this).text());
        //     console.log(text);
        //     let copyGfGText = 
        //         document.getElementById("copyText");
        //     console.log(copyGfGText);
 
        //     copyGfGText.select();

        //     document.execCommand(copy);
             
        //     //document.getElementById("gfg")
        //         // .innerHTML = "Copied the text: "
        //         // + copyGfGText.value;
        // }
        // function copyToClipboard(text) {
        //     console.log(text);
        //     const el = document.createElement('textarea');
        //     el.value = text;
        //     document.body.appendChild(el);
        //     el.select();
        //     document.execCommand('copy');
        //     document.body.removeChild(el);
        // }
    </script>
    
</body>
</html>