@extends('layouts.pdf')
@section('content')
<table style="width: 720px">
    <tr>
        <td><img src="companies/{{ session()->get('company_id').'/logo.jpg' }}" style="height:100px"/></td>
        <td valign="top" style="width: 200px"><div  style="text-align: right;"><b style="font-size:2rem;">Invoice</b></div>
            <table style="width:100%" >
            <tr>
                <td>Date:</td>
                <td>date</td>
            </tr>
            <tr>
                <td>Date:</td>
                <td>date</td>
            </tr>
            <tr>
                <td>Date:</td>
                <td>date</td>
            </tr>
            <tr>
                <td>Date:</td>
                <td>date</td>
            </tr>
        </table></td>
    </tr>
    <tr>
        <td colspan="2" valign="top"><br/>
            <table style="width: 100%; height:120px">
                <tr>
                    <td valign="top">83183 Watsica Landing<br/>
                        Lake Kathleen,<br/> AZ <br/>45603</td>
                </tr>
        </table></td>
    </tr>
    <tr>
        <td colspan="2"><hr></td>
    </tr>
</table>
@endsection
