<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

@extends('layouts.app')

@section('content')
<style>
        
                body {  

/* background-image: url('https://www.wmadaat.com/upload/white/white%20(11).jpg'); */
    background-attachment: fixed;
    background-position: center;
    background-size: cover;
    opacity: 5; /* قم بتعديل قيمة الشفافية حسب الحاجة */}
<a href="{{ route('school.index') }}" class="mr-auto" role="button">رجوع للخلف </a>
.small-table {
    width: 50%; /* تعيين عرض الجدول بنسبة مئوية */
    margin-left: 20px; /* تحديد المسافة من اليسار */
    border-collapse: collapse; /* دمج حدود الجدول */
}

.small-table th,
.small-table td {
    border: 1px solid #ddd; /* إضافة حدود للخلايا */
    padding: 8px; /* إضافة تباعد داخلي للخلايا */
    text-align: right; /* محاذاة النصوص إلى اليمين */
}

.small-table th {
    background-color: #f2f2f2; /* لون خلفية العناصر الرأسية */
}

.small-table tr:nth-child(even) {
    background-color: #f2f2f2; /* لون خلفية الصفوف الزوجية */
}

.small-table tr:hover {
    background-color: #ddd; /* تغيير لون خلفية الصفوف عند التحويم */
}

   
    body {   
        
        

    font-family: 'sans-serif';
    font-size: 18px;
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




<h1>
    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
</h1>

<a  href="{{ url('/') }}">العودة للصفحة الرئيسية</a>
<li class="active" ><a href="{{ route('subject.create') }}">لأضافة مادة</a></li>


<input type="text" id="categorySearch" oninput="filterCategories()" placeholder="ابحث عن الفئة ...">


<table name="idd" id="idd" border="0" cellpadding='0' cellspacing='0' style='text-align: left;' class='table table-hover table-striped'>
        <thead class="thead-dark">
            <tr >
                <th scope="col">رقم المادة</th>
                <th scope="col">أسم المادة</th>

         
           
                <th scope="col">تعديل</th>
                <th scope="col">لحفظ التعديلات</th>
                <th scope="col">لحذف المادة</th>


            </tr>
        </thead>
        <tbody>
            @php
            $i=1;
            @endphp
            @foreach ($subjects as $item)
            <tr >
                <td>{{$i++}}</td>
                <td>
                    <form action="{{ route('subject.update', $item->id) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <div class="form-group">
                            <input style="width: 200px;" type="text" class="form-control" name="name" id="name-{{ $item->id }}" value="{{ $item->name }}" disabled>
                        </div>
                </td>

                    </div>
          
                <td>
                    <button type="button" class="btn btn-secondary" onclick="enableEdit({{ $item->id }})">تمكين</button>
                </td>
                <td>
                    <button type="submit" class="btn btn btn-success" style="display: inline-block;">حفظ</button>
                </td>
                </form>
                <td>
        <form action="{{ route('subject.destroy',$item->id ) }}" method="POST" onsubmit="return confirm('هل أنت متأكد من رغبتك في حذف هذا المنتج؟')">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-danger">حذف</button>
</form>
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
    var descInput = document.getElementById('description-' + rowId);
    var d2escInput = document.getElementById('price-' + rowId);
    var d2es2cInput = document.getElementById('price2-' + rowId);
    var d3escInput = document.getElementById('quantity-' + rowId);

    nameInput.disabled = false;
    descInput.disabled = false;
    d2escInput.disabled = false;
    d3escInput.disabled = false;
    d2es2cInput.disabled = false;
    d3escInput.addEventListener('input', function() {
        if (d3escInput.value < 10) {
            d3escInput.style.backgroundColor = 'rgba(255, 0, 0, 0.3)';
        } else {
            d3escInput.style.backgroundColor = '';
        }
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

