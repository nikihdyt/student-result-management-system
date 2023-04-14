package models

type Matakuliah struct {
	KodeMK string `gorm:"type:varchar(10);primaryKey" json:"kode_mk"`
	NamaMK string `gorm:"type:varchar(20)" json:"nama_mk"`
	SKS    int    `gorm:"type:int" json:"sks"`
}
