<table class="table table-striped table-hover">
    <thead>
      <tr>
        <th scope="col">Id</th>
        <th scope="col">Nama</th>
        <th scope="col">Asal</th>
        <th scope="col">Tanggal Lahir</th>
        @if (auth()->user()->level == "superadmin" || auth()->user()->level == "admin")
          <th scope="col-2">Aksi</th>
        @endif
      </tr>
    </thead>
    <tbody>
        {{ $slot }}
    </tbody>
</table>