@php
    $days = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat'];
    $jamHeaders = ['06:30 - 07:30', '07:30 - 08:30', '08:30 - 09:30', '09:30 - 10:00', '10:00 - 11:00', '11:00 - 12:00'];
@endphp
<div class="sd-content sd-content-jadwal">
  <div class="content-header"><h1>Jadwal Pelajaran</h1><div class="header-right"><div class="avatar teal">{{ strtoupper(substr($siswa->nama, 0, 1)) }}</div></div></div>
  <div class="card"><div class="card-header"><h3><i class="fas fa-calendar-alt" style="color:var(--teal)"></i> Jadwal Mingguan</h3></div>
    <div class="table-wrap"><table><thead><tr><th>Hari</th><th>06:30 - 07:30</th><th>07:30 - 08:30</th><th>08:30 - 09:30</th><th>09:30 - 10:00</th><th>10:00 - 11:00</th><th>11:00 - 12:00</th></tr></thead>
    <tbody>
      @foreach($days as $day)
      @php $dayJadwal = $semuaJadwal->where('hari', $day); @endphp
      <tr><td><strong>{{ $day }}</strong></td>
        @foreach($jamHeaders as $jh)
          @php
            $parts = explode(' - ', $jh);
            $match = $dayJadwal->first(function($j) use ($parts) {
                return substr($j->jam_mulai, 0, 5) === $parts[0];
            });
          @endphp
          <td>{{ $match ? $match->mapel->nama_mapel : '' }}</td>
        @endforeach
      </tr>
      @endforeach
    </tbody></table></div>
  </div>
</div>
