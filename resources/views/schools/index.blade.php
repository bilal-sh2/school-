

    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
    <style>
        body {
            font-size: 16px;

            font-family: 'Arial', sans-serif;
            direction: rtl;
            text-align: right;
            margin: 20px;
        }

        table {
        border-collapse: collapse;
        width: 100%;
    }
    th{
        font-size: 18px; /* تعيين حجم الخط الذي ترغب به */
    }

    table, th, td ,select{
        border: 
        border-radius: 10px;
    }
    

    th, td ,select{
        padding: 15px;
        text-align: center;
    }

    input[type="text"] {
        padding: 10px;
        border: 1px solid #ddd;
        border-radius: 5px;
    }

    button {
        padding: 10px 20px;
        border: 1px solid #4CAF50;
        background-color: #4CAF50;
        color: white;
        border-radius: 5px;
        cursor: pointer;
    }

    button:disabled {
        background-color: #ddd;
        color: #666;
        border: 1px solid #666;
        cursor: not-allowed;
    }

        select {
            width: 100%;
            padding: 6px;
            box-sizing: border-box;
            font-size: 18px; /* تعيين حجم الخط الذي ترغب به */

        }

    /* تخصيص مظهر حقل الاختيار كرايديو بطن */


    label {
        display: inline-block;
        margin: 5px;
        padding: 10px;
        border: 2px solid #4CAF50;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s;

    }


    input[type="radio"]:checked + label {
        size: 15px;
        background-color: #4CAF50;
        color: white;
    }
    h2 {
        font-family: 'Arial', sans-serif; /* اختر الخط الذي تفضله */
        color: #4CAF50; /* اختر لون الخط الذي يتناسب مع تصميمك */
        text-align: center; /* توسيط النص */
        padding: 20px; /* إضافة تباعد داخلي لجعله أجمل */
        border-radius: 10px; /* إضافة زوايا مستديرة */
        background-color: #f2f2f2; /* إضافة لون خلفية للخلفية */
    }
    
    #diagnosisInput {
            width: 300px;
        }

       
</style>
@extends('layouts.app')

@section('content')

    <!-- <a href="{{ url('/') }}">العودة للصفحة الرئيسية</a> -->

    <div class="container">
        @if ($message = Session::get('success'))
            <div class="alert alert-primary" role="alert">
                {{$message}}
            </div>
        @endif
    </div>



<center>
 
    <input type="text" id="categorySearch" oninput="filterCategories()" placeholder="البحث">




</center>

   <div class="body">
    <div class="container">


    <table class="table table-bordered table-hover" >
    <thead class="thead-dark">
        <tr>
        <th scope="col">الرقم</th>
                        <th scope="col">أسم المدرسة</th>
                        <th scope="col">الموقع</th>
                        <th scope="col">تعديل</th>
                        <th scope="col">حذف المدرسة</th>
                        <th scope="col">الدخول للمدرسة </th>
        </tr>
    </thead>
    <tbody>
                    @php 
                        $i=1; 
                    @endphp
                    @foreach ($schools as $item)
                        <tr>
                

                            <td>      <p style="color: black;">{{$i++}}</p> </p> </td> 
                            <td>
                                <form action="{{ route('school.update', $item->id) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="name" id="name-{{ $item->id }}" value="{{ $item->name }}" disabled>
                                    </div>
                            </td>
                            <td>
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="location" id="location-{{ $item->id }}" value="{{ $item->location }}" disabled>
                                    </div>
                            </td>
                            <td>
                                <button type="button" class="btn btn-secondary" onclick="enableEdit({{ $item->id }})">تمكين التعديل</button>
                                <button type="submit" class="btn btn btn-success" style="display: inline-block;">حفظ التعديلات</button>
                            </form>
                            
                            
                            </td>
                            <form action="{{ route('school.destroy',$item->id ) }}" method="POST" onsubmit="return confirm('هل أنت متأكد من رغبتك في حذف هذه الفئة مع البيانات التي فيها')">
                        <td>
                    @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">حذف</button>
                    </form>
                <td>
                    <div class="col-sm">
                    <a  class="btn btn-primary" href="{{ route('school.show' ,$item->id )}}">إظهار</a>
    </div>
                </td>
                
                            
                        </tr>
                    @endforeach
                </tbody>
</table>



    <script>

        // };
        function filterCategories() {
                var input, filter, table, tr, td, i, txtValue;
                input = document.getElementById("categorySearch");
                filter = input.value.toUpperCase();
                table = document.querySelector("table");
                tr = table.getElementsByTagName("tr");

                for (i = 0; i < tr.length; i++) {
                    td = tr[i].getElementsByTagName("td")[1]; // تم تعديل هذا الجزء ليناسب البحث حسب الاسم
                    if (td) {
                        txtValue = td.getElementsByTagName("input")[2].value; // تم تعديل هذا الجزء للحصول على القيمة المدخلة
                        if (txtValue.toUpperCase().indexOf(filter) > -1) {
                            tr[i].style.display = "";
                        } else {
                            tr[i].style.display = "none";
                        }
                    }
                }
            }



        function enableEdit(rowId) {
            var nameInput = document.getElementById('name-' + rowId);
            var locinput = document.getElementById('location-' + rowId);
            nameInput.disabled = false;
            locinput.disabled = false;
        }

        function printPage() {
            window.print();
        }
    </script>
@endsection
