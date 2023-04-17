<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>UTS SAIT</title>
    <script>
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();   
        });
    </script>
    <script src="https://cdn.tailwindcss.com"></script>
</head>


<body>
    <h1 class="text-[50px] text-center">UTS PSAIT</h1>
    <p class="text-center">Niki Hidayati | 21/477478/SV/19186 | PL4AA</p>
    <div class="px-[120px] py-[20px]">
        <!-- Table -->
        <div class="w-full  mx-auto bg-white shadow-lg rounded-sm border border-gray-200">
                                    <div class="px-5 py-4 border-b border-gray-100 grid grid-cols-3">
                                        <div class="font-semibold text-gray-800 text-[24px]">Daftar Nilai Mahasiswa</div>
                                        <div></div>
                                        <form action="getNilaiByNIM.php" method="get">   
                                            <label for="search" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
                                            <div class="relative">
                                                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                                    <svg aria-hidden="true" class="w-5 h-5 text-gray-500" fill="none" stroke="#000" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                                                </div>
                                                <input type="search" id="search" name="nim" class="block w-full p-4 pl-10 text-sm text-black placeholder:text-black border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500" placeholder="Cari NIM Mahasiswa" name="nim">
                                                <button type="submit" class="text-white absolute right-2.5 bottom-2.5 bg-[#3A4F7A] hover:bg-[#3A4F7A] focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2">Search</button>
                                            </div>
                                        </form>

                                    </div>
                        
                                    <div class="overflow-x-auto p-3">
                                        <table class="table-auto w-full" id="table-body">
                                            <thead class="text-xs font-semibold uppercase text-gray-700 bg-[#E8C4C4] p-2">
                                                <tr class="text-left">
                                                    <th>
                                                        NIM
                                                    </th>
                                                    <th>
                                                        Nama
                                                    </th>
                                                    <th>
                                                        Alamat
                                                    </th>
                                                    <th>
                                                        Tanggal Lahir
                                                    </th>
                                                    <th>
                                                        Kode Mata Kuliah
                                                    </th>
                                                    <th>
                                                        Nama Mata Kuliah
                                                    </th>
                                                    <th>
                                                        SKS
                                                    </th>
                                                    <th>
                                                        Nilai
                                                    </th>
                                                    <th></th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                        
                                            <?php
                                            $curl= curl_init();
                                            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                                            //Pastikan sesuai dengan alamat endpoint dari REST API di UBUNTU, 
                                            curl_setopt($curl, CURLOPT_URL, 'http://localhost:8080/v1/nilai');
                                            $res = curl_exec($curl);
                                            $json = json_decode($res, true);

                                            echo 
                                            '
                                            <tbody class="text-sm divide-y divide-gray-100">
                                            ';
                                            for ($i = 0; $i < count($json["data"]); $i++){
                                                echo '
                                                <tr class="font-medium text-gray-700">
                                                    <td class="p-2">
                                                        <div class="">
                                                            ' . $json["data"][$i]["nim"] . '
                                                        </div>
                                                    </td>
                                                    <td class="p-2">
                                                        <div class="">
                                                            ' . $json["data"][$i]["nama"] . '
                                                        </div>
                                                    </td>
                                                    <td class="p-2">
                                                        <div class=" ">
                                                            ' . $json["data"][$i]["alamat"] . '
                                                        </div>
                                                    </td>
                                                    <td class="p-2">
                                                        <div class=" ">
                                                        ' . $json["data"][$i]["tanggal_lahir"] . '
                                                        </div>
                                                    </td>
                                                    <td class="p-2">
                                                        <div class=" ">
                                                        ' . $json["data"][$i]["kode_mk"] . '
                                                        </div>
                                                    </td>
                                                    <td class="p-2">
                                                        <div class=" ">
                                                        ' . $json["data"][$i]["nama_mk"] . '
                                                        </div>
                                                    </td>
                                                    <td class="p-2">
                                                        <div class=" ">
                                                        ' . $json["data"][$i]["sks"] . '
                                                        </div>
                                                    </td>
                                                    <td class="p-2">
                                                        <div class=" ">
                                                        ' . $json["data"][$i]["nilai"] . '
                                                        </div>
                                                    </td>
                                                    <td class="p-2">
                                                        <div class="flex justify-center">
                                                        <a href="updateNilaiView.php?nim='. $json["data"][$i]["nim"] .'&kode_mk='. $json["data"][$i]["kode_mk"] .'">
                                                                <img 
                                                                    src="https://upload.wikimedia.org/wikipedia/commons/thumb/6/64/Edit_icon_%28the_Noun_Project_30184%29.svg/1024px-Edit_icon_%28the_Noun_Project_30184%29.svg.png"
                                                                    alt=""
                                                                    class="w-8 h-8 hover:text-red-600 hover:bg-gray-100 p-1" >
                                                            </a>
                                                        </div>
                                                    </td>
                                                    <td class="p-2">
                                                        <div class="flex justify-center">
                                                            <a href="deleteNilai.php?nim='. $json["data"][$i]["nim"] .'&kode_mk='. $json["data"][$i]["kode_mk"] .'">
                                                                <svg class="w-8 h-8 hover:text-red-600 hover:bg-gray-100 p-1"
                                                                    fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                                                    xmlns="http://www.w3.org/2000/svg">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                                                    </path>
                                                                </svg>
                                                            </a>
                                                        </div>
                                                    </td>
                                                </tr>
                                                ';
                                            }
                        
                                            echo 
                                            '
                                            </tbody>
                                            ';

                                            curl_close($curl);
                                            ?>


                                        </table>    
                                    </div>
                                    
                                    <div class="grid grid-cols-2">
                                        <a href="createNilaiView.php"
                                                class="bg-[#2B3A55] w-fit text-white text-center mx-[12px] my-auto px-[12px] py-[4px] rounded-[8px]" >
                                                    Add New
                                        </a>
                                        <!-- <div class="flex justify-end font-bold space-x-4 text-2xl border-t border-gray-100 px-5 py-4">
                                            <div>Total Mahasiswa:</div>
                                            <div class="text-blue-600">
                                            <span x-text="total.toFixed(2)">
                                                
                                            </span>
                                            </div>
                                        </div> -->
                                    </div>
                        
                                    <div class="flex justify-end">
                                        <input type="hidden" class="border border-black bg-gray-50" x-model="selected" />
                                    </div>
            </div>
            <!-- table end -->
    </div>
</body>
</html>