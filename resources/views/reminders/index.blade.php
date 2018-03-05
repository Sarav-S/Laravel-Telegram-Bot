@extends('layouts.app')

@section('content')
    <div class="container">
        @include('reminders._create')
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Reminders</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif

                        @if (count($reminders))
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th>Remind About</th>
                                    <th>Frequency</th>
                                    <th>Time</th>
                                    <th>Expression</th>
                                    <th>Run Once?</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($reminders as $reminder)
                                    <tr>
                                        <td>{{ $reminder->body }}</td>
                                        <td>{{ ucfirst($reminder->frequency) }}</td>
                                        <td>{{ $reminder->time }}</td>
                                        <td>{{ $reminder->expression }}</td>
                                        <td>{{ $reminder->run_once ? "YES" : "NO" }}</td>
                                        <td>
                                            <form action="{{ route('reminders.destroy', $reminder->id) }}"
                                                  method="POST">
                                                {{ method_field('DELETE') }}
                                                {{ csrf_field() }}
                                                <button class="btn btn-link btn-sm">DELETE</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        @else
                            <div class="alert alert-light" role="alert">
                                No reminders found.
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
