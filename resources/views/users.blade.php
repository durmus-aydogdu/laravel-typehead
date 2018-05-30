@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Users</div>
                    <div class="card-body">
                        <div class="text-center">
                            <input id="qsearch" type="text" class="typeahead form-control" placeholder="Search user" autocomplete="off">
                        </div>
                        <table>
                            <th>Name</th>
                            <th>Email</th>
                            @foreach($users as $user)
                                <tr>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                    <div id="pagination">
                        {{ $users->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script type="text/javascript">
        $(document).ready(function () {
            var users = new Bloodhound({
                datumTokenizer: Bloodhound.tokenizers.obj.whitespace('name'),
                queryTokenizer: Bloodhound.tokenizers.whitespace,
                remote: {
                    url: '/search-users/%QUERY',
                    wildcard: '%QUERY'
                }
            });

            $('#qsearch').typeahead({
                    highlight: true,
                    minLength: 1,
                    limit:5
                },
                {
                    name: 'name',
                    display: 'name',
                    source: users,
                    templates: {
                        empty: [
                            '<h5 class="suggestion-header"> Users </h5> <div class="suggestion-empty">',
                            '<b>user not found</b>',
                            '</div>'
                        ].join('\n'),
                        header: '<h5 class="suggestion-header"> Users </h5>'
                    }
                }).on('typeahead:selected', function(event, datum) {
                    window.alert("selected user name: "+datum.name + " email: "+datum.email);
            });
        });
    </script>
@endsection