<h1>Create Ticket</h1>

<form method="POST" action="{{ route('tickets.store') }}">
    @csrf

    <div>
        <label>Title</label><br>
        <input type="text" name="title" required>
    </div>

    <br>

    <div>
        <label>Description</label><br>
        <textarea name="description" required></textarea>
    </div>

    <br>

    <button type="submit">Save Ticket</button>
</form>

<br>
<a href="{{ route('tickets.index') }}">Back</a>