<form action="{{ url('reminders') }}" method="POST">
    @csrf
    @if (count($errors))
    <ul class="alert alert-danger list-unstyled">
        @foreach($errors->all() as $error)
        <li>
            {{ $error }}
        </li>
        @endforeach
    </ul>
    @endif
    <div class="row">
        <div class="col-sm-4">
            <label for="body">
                Remind About
            </label>
            <input class="form-control" id="body" name="body" placeholder="Eg. Call Parents" type="text">
            </input>
        </div>
        <div class="col-sm-2">
            <label for="day">
                Frequency
            </label>
            <select class="form-control" id="frequency" name="frequency" required="required">
                @foreach($date->frequencies() as $key => $frequency)
                <option value="{{ $key }}">
                    {{ $frequency }}
                </option>
                @endforeach
            </select>
        </div>
        <div class="col-sm-2">
            <label for="day">
                Day
            </label>
            <select class="form-control" id="day" name="day">
                <option value="">
                    Choose
                </option>
                @foreach($date->days() as $key => $day)
                <option value="{{ $key }}">
                    {{ $day }}
                </option>
                @endforeach
            </select>
        </div>
        <div class="col-sm-2">
            <label for="date">
                Date
            </label>
            <select class="form-control" id="date" name="date">
                <option value="">
                    Choose
                </option>
                @foreach(range(1, \Carbon\Carbon::now()->endOfMonth()->format('d')) as $day)
                <option value="{{ $day }}">
                    {{ $date->ordinal($day) }}
                </option>
                @endforeach
            </select>
        </div>
        <div class="col-sm-2">
            <label for="time">
                Time
            </label>
            <select class="form-control" id="time" name="time" required="required">
                @foreach($date->range('00:00', '24:00') as $key => $time)
                <option value="{{ $time->format('H:i') }}">
                    {{ $time->format('H:i') }}
                </option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="form-group">
                <input id="run_once" name="run_once" type="checkbox">
                    <label for="run_once">
                        Run Once
                    </label>
                </input>
            </div>
            <div class="form-group">
                <button class="btn btn-primary">
                    Save Reminder
                </button>
            </div>
        </div>
    </div>
    <br/>
</form>
