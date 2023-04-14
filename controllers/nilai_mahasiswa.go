package controllers

import (
	"encoding/json"
	"errors"
	"net/http"
	"time"
	"uts_sait_mahasiswa/connection"
	"uts_sait_mahasiswa/helper"
	"uts_sait_mahasiswa/models"

	"github.com/gorilla/mux"
	"gorm.io/gorm"
)

var ResponseJson = helper.ResponseJson
var ResponseError = helper.ResponseError

func Read(w http.ResponseWriter, r *http.Request) {
	var data []models.DataMahasiswa

	nim := r.URL.Query().Get("nim")

	if nim != "" {
		if err := connection.DB.
			Table("perkuliahan").
			Select("*").
			Joins("JOIN mahasiswa ON mahasiswa.nim = perkuliahan.nim").
			Joins("JOIN matakuliah ON matakuliah.kode_mk = perkuliahan.kode_mk").
			Where("mahasiswa.nim = ?", nim).
			Find(&data).Error; err != nil {
			ResponseError(w, http.StatusInternalServerError, err.Error())
			return
		}
	} else {
		if err := connection.DB.
			Table("perkuliahan").
			Select("*").
			Joins("JOIN mahasiswa ON mahasiswa.nim = perkuliahan.nim").
			Joins("JOIN matakuliah ON matakuliah.kode_mk = perkuliahan.kode_mk").
			Find(&data).Error; err != nil {
			ResponseError(w, http.StatusInternalServerError, err.Error())
			return
		}
	}

	responseData := make(map[string]interface{})
	responseData["data"] = data
	responseData["message"] = "Success Mendapatkan Semua Nilai Mahasiswa"

	ResponseJson(w, http.StatusOK, responseData)

}

func Create(w http.ResponseWriter, r *http.Request) {

	var data models.Perkuliahan
	var dataMahasiswa models.DataMahasiswa
	decoder := json.NewDecoder(r.Body)
	if err := decoder.Decode(&data); err != nil {
		ResponseError(w, http.StatusInternalServerError, err.Error())
		return
	}

	defer r.Body.Close()

	// jelaskan kenapa diberi validasi ini
	// karna kalo engga: saat menghapus data, data sebanyak apapun yang dengan nim & kode mk sama akan dihapus
	// dikarekan params yg diminta soal  untuk delete itu nim & kode mk, bukan id yang unik
	// jadi, saya asumsikan nilai yang bisa di create itu hanya satu untuk setiap kombinasi mahaasiswa dan matakuliah
	var count int64
	connection.DB.Table("perkuliahan").
		Where("nim = ? AND kode_mk = ?", data.Nim, data.KodeMK).
		Count(&count)
		
	if count > 0 {
		ResponseError(w, http.StatusConflict, "Tidak dapat menambahkan nilai mahasiswa yang sudah ada (telah terdapat data dengan nim dan kode_mk yang sama)")
		return
	}

	if err := connection.DB.
		Table("perkuliahan").Where("nim = ? AND kode_mk = ?", data.Nim, data.KodeMK).Create(&data).Error; err != nil {
		ResponseError(w, http.StatusInternalServerError, err.Error())
		return
	}

	if err := connection.DB.
		Table("perkuliahan").
		Select("*").
		Joins("JOIN mahasiswa ON mahasiswa.nim = perkuliahan.nim").
		Joins("JOIN matakuliah ON matakuliah.kode_mk = perkuliahan.kode_mk").
		Where("perkuliahan.nim = ? AND perkuliahan.kode_mk = ?", data.Nim, data.KodeMK).
		Find(&dataMahasiswa).Error; err != nil {
		ResponseError(w, http.StatusInternalServerError, err.Error())
		return
	}

	meta := make(map[string]interface{})
	meta["created_at"] = time.Now()

	responseData := make(map[string]interface{})
	responseData["data"] = dataMahasiswa
	responseData["meta"] = meta
	responseData["message"] = "Success Create Nilai Mahasiswa"

	ResponseJson(w, http.StatusCreated, responseData)

}

func Update(w http.ResponseWriter, r *http.Request) {
	params := mux.Vars(r)
	nim := params["nim"]
	kodeMk := params["kode_mk"]

	var data models.DataMahasiswa
	decoder := json.NewDecoder(r.Body)
	if err := decoder.Decode(&data); err != nil {
		ResponseError(w, http.StatusInternalServerError, err.Error())
		return
	}

	defer r.Body.Close()

	result := connection.DB.Table("perkuliahan").
		Where("nim = ? AND kode_mk = ?", nim, kodeMk).
		First(&models.DataMahasiswa{})

	if errors.Is(result.Error, gorm.ErrRecordNotFound) {
		ResponseError(w, http.StatusNotFound, "Data tidak ditemukan")
		return
	}

	if err := connection.DB.Table("perkuliahan").
		Where("nim = ? AND kode_mk = ?", nim, kodeMk).
		Update("nilai", data.Nilai).Error; err != nil {
		ResponseError(w, http.StatusInternalServerError, err.Error())
		return
	}

	if err := connection.DB.
		Table("perkuliahan").
		Select("*").
		Joins("JOIN mahasiswa ON mahasiswa.nim = perkuliahan.nim").
		Joins("JOIN matakuliah ON matakuliah.kode_mk = perkuliahan.kode_mk").
		Where("perkuliahan.nim = ? AND perkuliahan.kode_mk = ?", nim, kodeMk).
		Find(&data).Error; err != nil {
		ResponseError(w, http.StatusInternalServerError, err.Error())
		return
	}

	meta := make(map[string]interface{})
	meta["updated_at"] = time.Now()

	responseData := make(map[string]interface{})
	responseData["data"] = data
	responseData["meta"] = meta
	responseData["message"] = "Success Update Nilai Mahasiswa"

	ResponseJson(w, http.StatusOK, responseData)

}

func Delete(w http.ResponseWriter, r *http.Request) {
	params := mux.Vars(r)
	nim := params["nim"]
	kodeMk := params["kode_mk"]

	var data models.DataMahasiswa

	result := connection.DB.Table("perkuliahan").
		Where("nim = ? AND kode_mk = ?", nim, kodeMk).
		First(&models.DataMahasiswa{})

	if errors.Is(result.Error, gorm.ErrRecordNotFound) {
		ResponseError(w, http.StatusNotFound, "Data tidak ditemukan")
		return
	}

	if err := connection.DB.Table("perkuliahan").
		Where("nim = ? AND kode_mk = ?", nim, kodeMk).
		Delete(data).Error; err != nil {
		ResponseError(w, http.StatusInternalServerError, err.Error())
		return
	}

	meta := make(map[string]interface{})
	meta["deleted_at"] = time.Now()

	responseData := make(map[string]interface{})
	responseData["meta"] = meta
	responseData["message"] = "Success Update Nilai Mahasiswa"

	ResponseJson(w, http.StatusOK, responseData)

}
