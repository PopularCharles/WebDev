<?php $page="index"; ?>
@extends('layout.mainlayout')
@section('content')
<div class='page-wrapper'>
<table>
    <tr>
        <th>Day</th>
        <th>Number</th>
    </tr>
     @foreach ($data as $data)
    <tr>
        <th>{{ $data->Day }}</th>
        <th>{{ $data->Number }}</th>
        <th><button id="editButton" onclick="showEditForm()">Edit</button></th>
        <th>
            <form action="{{ route('data.destroy', $data->Day) }}" method="post">
            @csrf
            <input type='hidden' name = 'day1' value = "{{$data->Day}}">
            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
            </form>
        </th>
    </tr>   
    @endforeach
    <tr>
        <th><button id="addButton" onclick="showAddForm()">Add</button></th>
    </tr>
</table>

    <form id="addForm" style="display: none;" method="POST" action="{{ route('addtest.custom')}}">
    @csrf	
    <label for="Day">Day:</label><br>
    <input type="text" id="day" name="day"><br>
    <label for="Number">Number</label><br>
    <input type="text" id="number" name="number"><br>
    <input type="submit" value="Submit">
    </form>

    <form id="editForm" style="display: none;" method="POST" action="{{ route('data.update', $data->Day) }}">
    @csrf
    <label for="Day">Day:</label><br>
    <input type="text" id="day" name="day" value="{{ $data->Day }}" readonly><br>
    <label for="Number">Number</label><br>
    <input type="text" id="number" name="number" value="{{ $data->number }}"><br>
    <input type="submit" value="Submit">
    </form>
</div>


    

@endsection

@section('script')
<script>
function showAddForm() {
document.getElementById("addForm").style.display = "block";
document.getElementById("editForm").style.display = "none";
}
function showEditForm() {
 document.getElementById("editForm").style.display = "block";
 document.getElementById("addForm").style.display = "none";
}
</script>
@endsection