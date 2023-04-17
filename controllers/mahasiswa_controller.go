package controllers

import (
	"net/http"
	"uts_sait_mahasiswa/connection"
	"uts_sait_mahasiswa/models"
)


func ReadMahasiswa(w http.ResponseWriter, r *http.Request) {
	var data []models.Mahasiswa

	if err := connection.DB.Table("mahasiswa").Select("*").Find(&data).Error; err != nil {
		ResponseError(w, http.StatusInternalServerError, err.Error())
		return
	}

	responseData := make(map[string]interface{})
	responseData["data"] = data
	responseData["message"] = "Success Mendapatkan Semua Mahasiswa"

	ResponseJson(w, http.StatusOK, responseData)

}
