@if($errors->any())
    <script>
        Swal.fire({
            icon: "error",
            title: "Oops...",
            html: `
            <ol>
               @foreach ($errors->all() as $error)
                <li style="text-align: left">{{$error}}</li>
               @endforeach
            </ul>
            `,
            showConfirmButton: true,
        });
    </script>
@elseif(session()->has('error'))
    <script>
        Swal.fire({
            icon: "error",
            title: "Oops...",
            html: `
               <h3>{{session()->get('error')}}</h3>
            `,
            showConfirmButton: true,
        });
    </script>
@elseif(session()->has('success'))
    <script>
        Swal.fire({
            icon: "success",
            title: "Success",
            text: "{{session()->get('success')}}",
            showConfirmButton: false,
            timer: 1700
        });
    </script>
@endif
