<table>
    <thead>
        <tr>
            <td colspan="8" style="text-align: center;">
                REKAPITULASI ATLET
            </td>
        </tr>
        <tr>
            <td colspan="8" style="text-align: center;">
                {{$kejuaraan->nama_kejuaraan}}
            </td>
        </tr>
        <tr>

        </tr>
        <tr>
            <th>
                <h4>No</h4>
            </th>
            <th>
                <h4>Nama Kontingen</h4>
            </th>
            <th>
                <h4>Nama Atlet</h4>
            </th>
            <th>
                <h4>Tempat Lahir</h4>
            </th>
            <th>
                <h4>Tanggal Lahir</h4>
            </th>
            <th>
                <h4>NIK</h4>
            </th>
            <th>
                <h4>Gender</h4>
            </th>
            <th>
                <h4>Golongan</h4>
            </th>
            <th>
                <h4>Jenis</h4>
            </th>
            <th>
                <h4>Kategori</h4>
            </th>
            <th>
                <h4>Status</h4>
            </th>
        </tr>
    </thead>
    <tbody>
        @foreach ($atlets as $atlet)
            <tr>
                <td>
                    {{$loop->iteration}}
                </td>
                <td>
                    {{$atlet->kontingen->nama_kontingen}}
                </td>
                <td>
                    {{$atlet->nama}}
                </td>
                <td>
                    {{$atlet->tempat_lahir}}
                </td>
                <td>
                    {{\Carbon\Carbon::parse($atlet->tanggal_lahir)->format('d/m/Y')}}
                </td>
                <td>
                    '{{$atlet->nik}}
                </td>
                <td>
                    {{$atlet->gender}}
                </td>
                <td>
                    {{$atlet->refKategori->refGolongan->nama}}
                </td>
                <td>
                    {{$atlet->refKategori->jenis}}
                </td>
                <td>
                    {{$atlet->refKategori->nama_kategori}}
                </td>
                <td>
                    {{$atlet->refStatus->nama}}
                </td>
            </tr>
        @endforeach
    </tbody>
</table>