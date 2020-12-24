<template>
    <div class='container py-4'>
        <div class='row justify-content-center'>
            <div class='col-md-12'>
            <div class='card'>
                <div class='card-header'>DATA PENGGUNA {{nama_sekolah}}</div>
                <div class='card-body'>
                    <button class="btn btn-danger btn-block btn-lg mb-2" @click = "resetRaporMutu(sekolah_id)">RESET RAPOR MUTU</button>
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th width="50" class="text-center">No</th>
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th>Jenis Responden</th>
                                    <th>Status Pengisian Instrumen</th>
                                    <th width="200" class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(pengguna, index) in all_pengguna.data" :key="pengguna.pengguna_id">
                                    <td width="50" class="text-center">{{ index + 1 }}</td>
                                    <td>{{ pengguna.nama }}</td>
                                    <td>{{ pengguna.email }}</td>
                                    <td class="text-center">
                                    {{ pengguna.peran ? pengguna.peran.nama : "-" }}
                                    </td>
                                    <td class="text-center" v-show="pengguna.peran_id == 10">
                                    {{ pengguna.rekap_kemajuan_count >= 618 ? "Selesai" : "Belum Selesai" }}
                                    </td>
                                    <td class="text-center" v-show="pengguna.peran_id == 53">
                                    {{ pengguna.rekap_kemajuan_count >= 498 ? "Selesai" : "Belum Selesai" }}
                                    </td>
                                    <td width="200" class="text-center">
                                        <div class="btn-group">
                                            <button class="btn btn-danger" @click = "isiInstrumen(pengguna.pengguna_id, pengguna.sekolah_id)">Isi Instrumen</button>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <pagination :data="all_pengguna" @pagination-change-page="getResults"></pagination>
                </div>
            </div>
            </div>
        </div>
        </div>
</template>

<script>
export default {
    data() {
        return {
          all_pengguna: {},
          nama_sekolah: null,
          sekolah_id: null,
        }
    },
    created() {
            this.getResults();
    },
    methods: {
        getResults(page){

            let uri = 'api/pengguna';
            this.axios.get(uri).then(response => {
                        return response.data;
                    }).then(data => {
                        this.all_pengguna = data;
                        this.nama_sekolah = data.sekolah.nama
                        this.sekolah_id = data.sekolah.sekolah_id
                    });
        },
        resetRaporMutu(sekolah_id){
            let uri = `api/reset-rapor-mutu`;
            this.axios.post(uri, {
                sekolah_id: sekolah_id,
            }).then(response => {
                this.$swal.fire({
                    title: 'Berhasil!',
                    text: 'Rapor Mutu berhasil direset!',
                    icon: 'success',
                })
            });
        },
        isiInstrumen(pengguna_id, sekolah_id)
        {
            const ipAPI = `api/isi-instrumen?pengguna_id=${pengguna_id}&sekolah_id=${sekolah_id}`;

            this.$swal.queue([{
                title: 'Isi Instrumen',
                confirmButtonText: 'Show my public IP',
                text: "Klik Lanjutkan untuk memproses isian instrumen.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Lanjutkan!',
                cancelButtonText: 'Batal',
                showLoaderOnConfirm: true,
                allowOutsideClick: () => !this.$swal.isLoading(),
                preConfirm: () => {
                    return fetch(ipAPI)
                    .then(response => response.json())
                    //.then(data => this.$swal.insertQueueStep(data.title))
                    //.then(this.getResults())
                    .then(data => 
                        //this.$swal.insertQueueStep({
                        this.$swal.fire({
                            icon: 'success',
                            title: data.title
                        }).then((result) => {
                            this.getResults();
                        })
                    )
                    .catch(() => {
                        this.$swal.insertQueueStep({
                            icon: 'error',
                            title: 'Gagal menyimpan instrumen. Silahkan coba beberapa saat lagi!'
                        })
                    })
                }
            }])
            return false;
            this.$swal.fire({
                title: 'Isi Instrumen',
                text: "Klik Lanjutkan untuk memproses isian instrumen.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Lanjutkan!',
                cancelButtonText: 'Batal',
                showLoaderOnConfirm: true,
                allowOutsideClick: () => !Swal.isLoading()
                }).then((result) => {
                if (result.value) {
                    let uri = `api/isi-instrumen`;
                    this.axios.get(uri, {
                        params: {
                            pengguna_id: pengguna_id,
                            sekolah_id: sekolah_id,
                        }
                    }).then(response => {
                        //this.articles.splice(this.articles.indexOf(id), 1);
                        this.$swal.fire({
                            title: 'Berhasil!',
                            text: 'Instrumen berhasil disimpan',
                            icon: 'success',
                        }).then((result) => {
                            this.getResults();
                        });
                    });
                    console.log("Deleted article with id ..." +pengguna_id);
                }
            })
        }
    }
  }
</script>