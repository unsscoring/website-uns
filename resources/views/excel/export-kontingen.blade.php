<table>
    <thead>
        <tr>
            <td colspan="9" style="text-align: center;">
                REKAPITULASI KONTINGEN
            </td>
        </tr>
        <tr>
            <td colspan="9" style="text-align: center;">
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
                <h4>Nama Manajer</h4>
            </th>
            <th>
                <h4>No WA</h4>
            </th>
            <th>
                <h4>Atlet Total</h4>
            </th>
            <th>
                <h4>Atlet Terverifikasi</h4>
            </th>
            <th>
                <h4>Status Pembayaran</h4>
            </th>
        </tr>
    </thead>
    <tbody>
        @foreach ($kontingens as $kontingen)
            <tr>
                <td>
                    {{$loop->iteration}}
                </td>
                <td>
                    {{$kontingen->nama_kontingen}}
                </td>
                <td>
                    {{$kontingen->nama_penanggung_jawab}}
                </td>
                <td>
                    {{$kontingen->no_wa_penanggung_jawab}}
                </td>
                <td>
                    {{$kontingen->jumlah_atlet}}
                </td>
                <td>
                    {{$kontingen->jumlah_terverifikasi}}
                </td>
                <td>
                    {{$kontingen->statusPembayaran?->nama ?? 'Belum Dibayar'}}
                </td>
            </tr>
        @endforeach
    </tbody>
</table>