package models

type Perkuliahan struct {
	IDPerkuliahan int     `gorm:"type:serial;primaryKey" json:"id_perkuliahan"`
	Nim           string  `gorm:"type:varchar(10), foreignKey:nim;references:mahasiswa(nim)" json:"nim"`
	KodeMK        string  `gorm:"type:varchar(10), foreignKey:kode_mk;references:matakuliah(kode_mk)" json:"kode_mk"`
	Nilai         float32 `gorm:"type:float64" json:"nilai"`
}
