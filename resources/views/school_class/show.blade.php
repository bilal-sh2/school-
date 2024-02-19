<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">


<style>
      body::before {
    content: "";
    background-image: url('لوغو دار حفص القراءة والتجويد نهااائي.png');
    background-attachment: fixed;
    background-position: center bottom; /* توضيح موقع الصورة في الوسط الأفقي وأسفل العمودي */
    background-size: cover;
    opacity: 0.1; /* تعديل شفافية الصورة */
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    z-index: -1; /* تأكد من أن الصورة خلفية */
}.logo-container {
    float: left;
}
        body {
            font-size: 16px;

            font-family: 'Arial', sans-serif;
            direction: rtl;
            text-align: right;
            margin: 20px;
        }

.small-table th,
.small-table td {
    border: 1px solid #ddd; /* إضافة حدود للخلايا */
    padding: 8px; /* إضافة تباعد داخلي للخلايا */
    text-align: right; /* محاذاة النصوص إلى اليمين */
}




/* اجعل العناصر النصية تستخدم الخط العريض */
td, th {
    font-weight: bold;
}

/* زينة لعناصر الروابط */
a {
    font-size: 18px;
    color: #000; /* اللون الأسود */
    text-decoration: none;
}



/* لتغيير اللون الخلفية وحجم الكتابة في الجدول */
table {
    background-color: #f0f0f0; /* لون الخلفية الرمادي الفاتح */
    font-size: 18px;
}

</style>

@extends('layouts.app')

@section('content')


<div class="container">
        @if ($message = Session::get('success'))
            <div class="alert alert-primary" role="alert">
                {{$message}}
            </div>
        @endif
    </div>


<form action="{{ route('student.store')}}" method="POST">
    @csrf
    <input type="text" class="form-control" id="num" name="class_id" required value={{$id}} style="display: none;">

    <table  class="small-table" border="0" cellpadding='0' cellspacing='0' style='text-align: right;' class='table table-hover table-striped'>
        <tr>
            <td><label for="name" class="form-label">اسم الطالب</label>   </td>
            <td><input type="text" class="form-control" id="name" name="name" required> </td>
        </tr>
        <tr>
            <td><label for="name" class="form-label">كلمة السر</label>   </td>
            <td><input type="text" class="form-control" id="passoward" name="passoward" required> </td>
        </tr>
        <tr>
            <td><label for="major" class="form-label">تاريخ الميلاد</label></td>
            <td><input type="date" class="form-control" id="num" name="birthdate" required> </td>
        </tr>
        <tr>
     
        <tr>
    <td><label for="major" class="form-label">عنوان سكن الطالب</label></td>
    <td><input type="float" class="form-control" id="num" name="address" required maxlength="20"> </td>
</tr>

    <td><label for="major" class="form-label">رقم التواصل الأول</label></td>
    <td><input type="text" class="form-control" id="num" name="parent_phone1"  > </td>
</tr>


        <tr>
            <td><label for="major" class="form-label">رقم التواصل الثاني </label></td>
            <td><input type="text" class="form-control" id="num" name="parent_phone2" required> </td>
        </tr>
        <td>
  <button type="submit" class="btn btn-primary">أضافة</button> 
        </td>
    </table>
</form>
<center>
    <input type="text" id="categorySearch" oninput="filterCategories()" placeholder="ابحث عن الطالب ...">

</center>


<table name="idd" id="idd" border="0" cellpadding='0' cellspacing='0' style='text-align: left;' class='table table-hover table-striped'>
        <thead class="thead-dark">
            <tr >
            <th scope="col">رقم الطالب </th>

                <th scope="col">اسم الطالب </th>
                <th scope="col">تاريخ الميلاد</th>
                <th scope="col">العنوان  </th>
                
                <th scope="col">رقم التواصل الاول</th>
               
                <th scope="col">رقم التواصل الاحتياطي</th>
 
                <th scope="col">تعديل</th>
                <th scope="col">لحفظ التعديلات</th>
                <th scope="col">لحذف الطالب</th>
                <th scope="col">عرض بيانات الطالب الطالب</th>
                <th scope="col">غيابات</th>

            

            </tr>
        </thead>
        <tbody>
            @php
            $i=1;
            @endphp
            @foreach ($students as $item)
            <tr >
                <td>{{$i++}}</td>
                <td>
                    <form action="{{ route('student.update', $item->id) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <div class="form-group">
                            <input style="width: 200px;" type="text" class="form-control" name="name" id="name-{{ $item->id }}" value="{{ $item->name }}" disabled>
                        </div>
                </td>
                <td>
                    <div class="form-group">
                        <input style="width: 200px;" type="text" class="form-control" name="birthdate" id="birthdate-{{ $item->id }}" value="{{ $item->birthdate }}" disabled>
                    </div>
                </td>
            
                <td>
                    <div class="form-group">
                        <input style="width: 100px;" type="text" class="form-control" name="address" id="address-{{ $item->id }}" value="{{ $item->address }}" disabled>
                    </div>
                </td>
            
                <td>
                    <div class="form-group">
                        <input style="width: 130px;" type="text" class="form-control" name="parent_phone1" id="parent_phone1-{{ $item->id }}" value="{{ $item->parent_phone1 }}" disabled>
                    </div>
                </td>
                <td>
                    <div class="form-group">
                        <input style="width: 130px;" type="text" class="form-control" name="parent_phone2" id="parent_phone2-{{ $item->id }}" value="{{ $item->parent_phone2 }}" disabled>
                    </div>
                </td>
                <td>
                    <button type="button" class="btn btn-secondary" onclick="enableEdit({{ $item->id }})">تمكين</button>
                </td>
                <td>
                    <button type="submit" class="btn btn btn-success" style="display: inline-block;">حفظ</button>
                </td>
                </form>
                <td>
        <form action="{{ route('student.destroy',$item->id ) }}" method="POST" onsubmit="return confirm('هل أنت متأكد من رغبتك في حذف هذا المنتج؟')">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-danger">حذف</button>
</form>
                </td>
                <td>
        <a  class="btn btn-primary" href="{{ route('student.show',$item->id )}}">أضافة علامات للطالب</a>
                </td>
                <td>
                <a class="btn btn-light" href="{{ route('add_absenceC.create', ['item_id' => $item->id, 'class_id' => $id]) }}">أضافة غياب للطالب</a>

                </td>
            </tr>
            @endforeach
    </table>
    <h5 class="w"> <div id="result"></div></h5>
    <br>
    <h5 class="e"> <div id="result2"></div></h5>
</div>
<script>
document.addEventListener('DOMContentLoaded', function() {
    var allQuantityFields = document.querySelectorAll('table tbody input[id^="quantity"]');
    allQuantityFields.forEach(function(field) {
        if (field.value < 10) {
            field.style.backgroundColor = 'rgba(255, 0, 0, 0.3)'; // أحمر كاشف
        }
    });
});

function enableEdit(rowId) {
    var nameInput = document.getElementById('name-' + rowId);
    var descInput = document.getElementById('birthdate-' + rowId);
    var d2escInput = document.getElementById('address-' + rowId);
    var d2es2cInput = document.getElementById('parent_phone1-' + rowId);
    var d3escInput = document.getElementById('parent_phone2-' + rowId);

    nameInput.disabled = false;
    descInput.disabled = false;
    d2escInput.disabled = false;
    d3escInput.disabled = false;
    d2es2cInput.disabled = false;
    d3escInput.addEventListener('input', function() {

    });
}
function checkPriceLength(input) {
    if (input.value.length > 6) {
        input.value = input.value.slice(0, 6);
    }
}


    function filterCategories() {
        var input, filter, table, tr, td, i, txtValue;
        input = document.getElementById("categorySearch");
        filter = input.value.toUpperCase();
        table = document.querySelector("idd");
        tr = idd.getElementsByTagName("tr");

        for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td")[1]; // تم تحديث الفهرس ليستهدف العمود الصحيح
            if (td) {
                txtValue = td.getElementsByTagName("input")[2].value; // تم تحديث هذا الفهرس للحصول على القيمة المناسبة
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                }
            }
        }
    }
</script>


@endsection
