package models

type DataMahasiswa struct {
	Nim          string  `json:"nim"`
	Nama         string  `json:"nama"`
	Alamat       string  `json:"alamat"`
	TanggalLahir string  `json:"tanggal_lahir"`
	KodeMK       string  `json:"kode_mk"`
	NamaMK       string  `json:"nama_mk"`
	SKS          int     `json:"sks"`
	Nilai        float32 `json:"nilai"`
}