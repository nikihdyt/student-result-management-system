package models


type Mahasiswa struct {
	Nim          string    `gorm:"type:varchar(10);primaryKey" json:"nim"`
	Nama         string    `gorm:"type:varchar(20)" json:"nama"`
	Alamat       string    `gorm:"type:varchar(40)" json:"alamat"`
	TanggalLahir string    `gorm:"type:date" json:"tanggal_lahir"`
}
