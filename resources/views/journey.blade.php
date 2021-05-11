<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Vista ejemplo</title>
</head>
<body>
    <h1>Travels</h1>

    <table>
        <thead>
            <tr>
                <th> id</th>
                <th> email</th>
                <th> name</th>
                <th> lastname</th>
                <th> cellphone</th> 
                <th> date  </th>
                <th> country </th>
                <th> city</th> 
            </tr>
        </thead> 
        <tbody>
            @foreach($travels as $travel)
            <tr>
                <td> {{$travel->id}} </td>
                <td> {{$travel->email_fk}} </td>
                <td> {{$travel->name}} </td>
                <td> {{$travel->lastname}} </td>
                <td> {{$travel->cellphone}} </td>
                <td> {{$travel->date}} </td>
                <td> {{$travel->country}} </td>
                <td> {{$travel->city}} </td> 
                <td> <a data-method="delete" href="{{ action('TravelController@delete' ,['id' => $travel->id]) }}" class="jquery-postback"><button class="btn btn-danger">
                        X
                    </button>
                    </a>
                </td> 
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>

<script>
$.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
});
$(document).on('click', 'a.jquery-postback', function(e) {
    e.preventDefault(); // does not go through with the link.

    var $this = $(this);

    $.post({
        type: $this.data('method'),
        url: $this.attr('href')
    }).done(function (data) {
        alert('success');
        console.log(data);
    });
});
</script>