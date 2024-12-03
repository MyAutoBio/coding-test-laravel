<x-layouts.app>
    <form method="POST" action="{{ route('file.upload') }}" enctype="multipart/form-data">
        @csrf
        <input type="file" name="file">
        <button type="submit">Upload file</button>
    </form>
</x-layouts.app>
