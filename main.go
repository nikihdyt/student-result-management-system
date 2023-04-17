package main

import (
	"log"
	"net/http"
	"uts_sait_mahasiswa/connection"
	"uts_sait_mahasiswa/controllers"

	"github.com/gorilla/mux"
)

func main() {
	connection.ConnectDatabase()
	r := mux.NewRouter()

	// Routes
	r.HandleFunc("/v1/nilai", controllers.Read).
		Methods("GET")
	r.HandleFunc("/v1/nilai", controllers.Create).
		Methods("POST")
	r.HandleFunc("/v1/nilai/{nim}/{kode_mk}", controllers.Update).
		Methods("PUT")
	r.HandleFunc("/v1/nilai/{nim}/{kode_mk}", controllers.Delete).
		Methods("DELETE")
	r.HandleFunc("/v1/msw", controllers.ReadMahasiswa).
		Methods("GET")

	log.Fatal(http.ListenAndServe(":8080", r))
}
