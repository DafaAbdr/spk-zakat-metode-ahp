-- =========================================================
-- DATA CONTOH: 107 PEMOHON ZAKAT + PENILAIAN SUB KRITERIA LENGKAP
-- Masjid Nurul Ikhsan Jakarta Barat
-- Jalankan file ini SETELAH database.sql berhasil diimport.
-- =========================================================
USE zakat_ahp;

INSERT INTO pemohon (nik, nama, jenis_kelamin, tempat_lahir, tanggal_lahir, alamat, no_hp, status_pernikahan) VALUES
('3172000000000001','Andi Pratama','L','Garut','1969-06-10','Jl. Kenanga No. 8, RT 001/RW 010, Kel. Srengseng, Jakarta Barat','08371786882','Duda'),
('3172000000000002','Khadijah Hidayat','P','Jakarta','1969-01-15','Jl. Melati No. 65, RT 006/RW 004, Kel. Duri Kosambi, Jakarta Barat','08272270601','Menikah'),
('3172000000000003','Sarno','L','Jakarta','1981-09-10','Jl. Seroja No. 61, RT 013/RW 004, Kel. Tomang, Jakarta Barat','08385572312','Janda'),
('3172000000000004','Yusuf Susanto','L','Garut','1972-06-06','Jl. Mawar No. 64, RT 009/RW 005, Kel. Cengkareng Timur, Jakarta Barat','','Menikah'),
('3172000000000005','Ahmad Permana','L','Kuningan','1994-09-01','Jl. Flamboyan No. 17, RT 009/RW 010, Kel. Duri Kosambi, Jakarta Barat','08458274382','Belum Menikah'),
('3172000000000006','Enung Rahayu','P','Indramayu','1966-06-10','Jl. Kamboja No. 16, RT 007/RW 009, Kel. Meruya Selatan, Jakarta Barat','08537687344','Menikah'),
('3172000000000007','Ahmad Maulana','L','Jakarta','1989-02-28','Jl. Teratai No. 42, RT 005/RW 006, Kel. Cengkareng Barat, Jakarta Barat','08248744422','Janda'),
('3172000000000008','Marni','P','Brebes','1995-01-25','Jl. Mawar No. 90, RT 007/RW 002, Kel. Kembangan Selatan, Jakarta Barat','08471238666','Duda'),
('3172000000000009','Neneng Rahayu','P','Tasikmalaya','1997-07-22','Jl. Anggrek No. 97, RT 003/RW 002, Kel. Grogol, Jakarta Barat','08252372923','Belum Menikah'),
('3172000000000010','Kokom','P','Garut','1995-01-01','Jl. Kenanga No. 82, RT 010/RW 008, Kel. Semanan, Jakarta Barat','','Belum Menikah'),
('3172000000000011','Herman Nugroho','L','Serang','1993-01-23','Jl. Teratai No. 74, RT 011/RW 009, Kel. Kembangan Selatan, Jakarta Barat','08522731467','Menikah'),
('3172000000000012','Tuti Anggara','P','Tegal','1984-04-24','Jl. Teratai No. 23, RT 002/RW 008, Kel. Kota Bambu Utara, Jakarta Barat','08298614665','Menikah'),
('3172000000000013','Gunawan Syahputra','L','Lampung','1978-06-22','Jl. Cempaka No. 45, RT 004/RW 001, Kel. Tanjung Duren Utara, Jakarta Barat','08431099632','Belum Menikah'),
('3172000000000014','Mahmud Ramadhan','L','Serang','1969-04-21','Jl. Mawar No. 80, RT 007/RW 009, Kel. Grogol, Jakarta Barat','08365362955','Duda'),
('3172000000000015','Rojak Setiadi','L','Cirebon','1974-07-23','Jl. Kenanga No. 46, RT 010/RW 007, Kel. Joglo, Jakarta Barat','08517030967','Janda'),
('3172000000000016','Syamsul Kusuma','L','Tasikmalaya','1974-03-07','Jl. Seroja No. 15, RT 011/RW 003, Kel. Grogol, Jakarta Barat','08211445659','Belum Menikah'),
('3172000000000017','Warni Handayani','P','Brebes','1964-09-14','Jl. Melati No. 26, RT 001/RW 006, Kel. Srengseng, Jakarta Barat','08588171786','Janda'),
('3172000000000018','Onah Setiawan','P','Kuningan','1997-10-09','Jl. Melati No. 97, RT 006/RW 004, Kel. Tegal Alur, Jakarta Barat','08137353312','Duda'),
('3172000000000019','Halimah Handayani','P','Tegal','2002-12-02','Jl. Teratai No. 17, RT 004/RW 007, Kel. Kedoya Utara, Jakarta Barat','','Menikah'),
('3172000000000020','Andi Pratama','L','Tasikmalaya','1961-02-03','Jl. Dahlia No. 36, RT 013/RW 003, Kel. Kembangan Utara, Jakarta Barat','08192093052','Menikah'),
('3172000000000021','Eko Wibowo','L','Indramayu','1998-03-20','Jl. Kamboja No. 30, RT 015/RW 005, Kel. Pegadungan, Jakarta Barat','08303386939','Menikah'),
('3172000000000022','Komar Saputra','L','Jakarta','1994-11-16','Jl. Dahlia No. 49, RT 003/RW 006, Kel. Tanjung Duren Utara, Jakarta Barat','08445199585','Belum Menikah'),
('3172000000000023','Bambang Yulianto','L','Garut','1967-01-26','Jl. Mawar No. 81, RT 011/RW 005, Kel. Meruya Utara, Jakarta Barat','08382099850','Janda'),
('3172000000000024','Lilis Yulianto','P','Brebes','1970-09-05','Jl. Cempaka No. 1, RT 007/RW 001, Kel. Cengkareng Barat, Jakarta Barat','08378678221','Duda'),
('3172000000000025','Hendra Rahman','L','Indramayu','1966-12-08','Jl. Anggrek No. 32, RT 011/RW 003, Kel. Kota Bambu Selatan, Jakarta Barat','08327493220','Menikah'),
('3172000000000026','Ida Wijaya','P','Serang','2000-02-20','Jl. Melati No. 95, RT 012/RW 002, Kel. Kalideres, Jakarta Barat','','Menikah'),
('3172000000000027','Joko Utami','L','Cirebon','1967-03-14','Jl. Anggrek No. 9, RT 015/RW 005, Kel. Tegal Alur, Jakarta Barat','08339574306','Janda'),
('3172000000000028','Mila Kusuma','P','Cirebon','1974-08-14','Jl. Teratai No. 62, RT 009/RW 005, Kel. Meruya Selatan, Jakarta Barat','08181694949','Menikah'),
('3172000000000029','Susi Ramadhan','P','Lampung','1978-04-01','Jl. Kenanga No. 20, RT 011/RW 009, Kel. Kedoya Selatan, Jakarta Barat','08373226193','Menikah'),
('3172000000000030','Khadijah Wijaya','P','Cirebon','1977-12-09','Jl. Anggrek No. 40, RT 004/RW 002, Kel. Tanjung Duren Utara, Jakarta Barat','','Belum Menikah'),
('3172000000000031','Sumiati Saputra','P','Tegal','1989-04-14','Jl. Anggrek No. 115, RT 010/RW 001, Kel. Wijaya Kusuma, Jakarta Barat','08133517204','Menikah'),
('3172000000000032','Mahmud','L','Cirebon','1959-06-24','Jl. Melati No. 118, RT 009/RW 005, Kel. Semanan, Jakarta Barat','08367512701','Menikah'),
('3172000000000033','Karta Wibowo','L','Garut','2000-11-26','Jl. Anggrek No. 24, RT 011/RW 004, Kel. Kedoya Utara, Jakarta Barat','','Janda'),
('3172000000000034','Mimin Setiawan','P','Brebes','1989-04-07','Jl. Melati No. 13, RT 015/RW 009, Kel. Tomang, Jakarta Barat','08113374249','Menikah'),
('3172000000000035','Rojak Utami','L','Tasikmalaya','1999-11-15','Jl. Melati No. 19, RT 001/RW 005, Kel. Kota Bambu Utara, Jakarta Barat','08133671995','Menikah'),
('3172000000000036','Hasan Anggara','L','Lampung','1994-11-23','Jl. Mawar No. 54, RT 006/RW 008, Kel. Joglo, Jakarta Barat','08335735426','Janda'),
('3172000000000037','Sumiati Setiawan','P','Brebes','1990-04-10','Jl. Cempaka No. 34, RT 007/RW 007, Kel. Kalianyar, Jakarta Barat','08531152789','Duda'),
('3172000000000038','Dedi Yulianto','L','Indramayu','2001-06-09','Jl. Kenanga No. 89, RT 008/RW 009, Kel. Wijaya Kusuma, Jakarta Barat','08137813813','Menikah'),
('3172000000000039','Titin Wardhana','P','Brebes','1981-01-17','Jl. Cempaka No. 66, RT 014/RW 005, Kel. Jelambar, Jakarta Barat','08537896509','Janda'),
('3172000000000040','Yani Wijaya','P','Lampung','1999-06-04','Jl. Kamboja No. 49, RT 003/RW 010, Kel. Duri Kosambi, Jakarta Barat','','Menikah'),
('3172000000000041','Sri Kusuma','P','Tasikmalaya','1993-09-17','Jl. Kenanga No. 24, RT 013/RW 009, Kel. Kapuk, Jakarta Barat','08233347496','Menikah'),
('3172000000000042','Toni Suryanto','L','Tegal','1968-03-20','Jl. Kamboja No. 87, RT 007/RW 006, Kel. Duri Kepa, Jakarta Barat','08361340421','Janda'),
('3172000000000043','Agus','L','Garut','1964-05-12','Jl. Kenanga No. 95, RT 008/RW 007, Kel. Duri Kosambi, Jakarta Barat','08222471980','Duda'),
('3172000000000044','Ahmad Hidayat','L','Brebes','1964-08-25','Jl. Seroja No. 11, RT 002/RW 010, Kel. Wijaya Kusuma, Jakarta Barat','08426791316','Duda'),
('3172000000000045','Tarsih Susanto','P','Indramayu','1959-09-18','Jl. Flamboyan No. 86, RT 012/RW 005, Kel. Cengkareng Timur, Jakarta Barat','','Menikah'),
('3172000000000046','Joko Yulianto','L','Serang','1980-07-09','Jl. Cempaka No. 43, RT 007/RW 009, Kel. Meruya Selatan, Jakarta Barat','08444385649','Menikah'),
('3172000000000047','Ujang Fadillah','L','Kuningan','1962-12-26','Jl. Teratai No. 76, RT 015/RW 010, Kel. Wijaya Kusuma, Jakarta Barat','08147944315','Janda'),
('3172000000000048','Ani Wijaya','P','Garut','1970-02-16','Jl. Seroja No. 118, RT 009/RW 002, Kel. Kota Bambu Selatan, Jakarta Barat','08241980502','Menikah'),
('3172000000000049','Sofyan','L','Tasikmalaya','1974-10-17','Jl. Teratai No. 72, RT 010/RW 009, Kel. Kalideres, Jakarta Barat','','Belum Menikah'),
('3172000000000050','Aminah Anggara','P','Indramayu','2001-08-12','Jl. Flamboyan No. 7, RT 005/RW 007, Kel. Pegadungan, Jakarta Barat','','Menikah'),
('3172000000000051','Toni Utami','L','Brebes','1962-11-03','Jl. Kenanga No. 7, RT 003/RW 003, Kel. Cengkareng Timur, Jakarta Barat','','Belum Menikah'),
('3172000000000052','Yani Maulana','P','Tasikmalaya','1995-05-10','Jl. Flamboyan No. 54, RT 004/RW 010, Kel. Jelambar, Jakarta Barat','08366694702','Menikah'),
('3172000000000053','Onah Nugroho','P','Serang','1990-09-19','Jl. Anggrek No. 78, RT 005/RW 001, Kel. Tanjung Duren Utara, Jakarta Barat','08535012735','Menikah'),
('3172000000000054','Wawan Firmansyah','L','Cirebon','1999-05-11','Jl. Kenanga No. 58, RT 005/RW 002, Kel. Joglo, Jakarta Barat','08395570002','Janda'),
('3172000000000055','Sukesih Handayani','P','Cirebon','2003-05-28','Jl. Flamboyan No. 47, RT 010/RW 008, Kel. Semanan, Jakarta Barat','08153505698','Belum Menikah'),
('3172000000000056','Rohani Hidayat','P','Tegal','1961-08-04','Jl. Mawar No. 42, RT 001/RW 001, Kel. Kalianyar, Jakarta Barat','','Janda'),
('3172000000000057','Karta','L','Tegal','1982-05-10','Jl. Anggrek No. 118, RT 006/RW 001, Kel. Tanjung Duren Utara, Jakarta Barat','','Janda'),
('3172000000000058','Wahyu Rahayu','L','Jakarta','1962-12-12','Jl. Cempaka No. 5, RT 012/RW 006, Kel. Kedoya Selatan, Jakarta Barat','08581144000','Janda'),
('3172000000000059','Suryadi Wardhana','L','Cirebon','1992-10-08','Jl. Anggrek No. 65, RT 012/RW 002, Kel. Tegal Alur, Jakarta Barat','08483476735','Janda'),
('3172000000000060','Paino','L','Tasikmalaya','1965-10-17','Jl. Dahlia No. 116, RT 010/RW 004, Kel. Kedoya Utara, Jakarta Barat','08523783188','Menikah'),
('3172000000000061','Ida','P','Indramayu','1982-11-06','Jl. Anggrek No. 96, RT 003/RW 009, Kel. Pegadungan, Jakarta Barat','08408135953','Duda'),
('3172000000000062','Sugianto Wibowo','L','Cirebon','1972-11-14','Jl. Teratai No. 68, RT 010/RW 007, Kel. Duri Kosambi, Jakarta Barat','08431628824','Janda'),
('3172000000000063','Sarno Wibowo','L','Serang','1966-08-08','Jl. Kamboja No. 120, RT 001/RW 005, Kel. Kalianyar, Jakarta Barat','08527647561','Janda'),
('3172000000000064','Warni Lestari','P','Tegal','1976-04-24','Jl. Anggrek No. 36, RT 008/RW 005, Kel. Cengkareng Barat, Jakarta Barat','','Janda'),
('3172000000000065','Painem Permana','P','Brebes','2001-08-16','Jl. Seroja No. 14, RT 001/RW 004, Kel. Kota Bambu Utara, Jakarta Barat','08435999678','Menikah'),
('3172000000000066','Sugianto Permana','L','Garut','1971-11-23','Jl. Kenanga No. 91, RT 014/RW 006, Kel. Jelambar, Jakarta Barat','08485110732','Janda'),
('3172000000000067','Ujang Yulianto','L','Tegal','1988-07-19','Jl. Teratai No. 30, RT 014/RW 002, Kel. Meruya Selatan, Jakarta Barat','08277153294','Menikah'),
('3172000000000068','Salim Setiawan','L','Indramayu','1995-07-15','Jl. Teratai No. 100, RT 009/RW 006, Kel. Jelambar, Jakarta Barat','','Menikah'),
('3172000000000069','Salim Wardhana','L','Lampung','1996-01-26','Jl. Mawar No. 65, RT 003/RW 004, Kel. Kapuk, Jakarta Barat','08147053248','Menikah'),
('3172000000000070','Jalaludin','L','Lampung','1962-11-04','Jl. Kamboja No. 107, RT 003/RW 005, Kel. Duri Kepa, Jakarta Barat','08326180143','Duda'),
('3172000000000071','Yayah Kurniawan','P','Garut','1968-04-13','Jl. Teratai No. 42, RT 004/RW 006, Kel. Joglo, Jakarta Barat','08581242523','Menikah'),
('3172000000000072','Fatimah Kusuma','P','Garut','1987-01-09','Jl. Mawar No. 51, RT 008/RW 009, Kel. Duri Kepa, Jakarta Barat','08326015434','Janda'),
('3172000000000073','Mimin Rahman','P','Tegal','1961-01-04','Jl. Kamboja No. 83, RT 015/RW 006, Kel. Tegal Alur, Jakarta Barat','','Menikah'),
('3172000000000074','Suryani Rahayu','P','Cirebon','1960-01-07','Jl. Flamboyan No. 93, RT 001/RW 009, Kel. Cengkareng Timur, Jakarta Barat','08162430930','Belum Menikah'),
('3172000000000075','Nani Susanto','P','Tegal','1971-03-12','Jl. Mawar No. 40, RT 015/RW 009, Kel. Tanjung Duren Selatan, Jakarta Barat','08549709801','Menikah'),
('3172000000000076','Kokom Permana','P','Indramayu','1989-02-14','Jl. Cempaka No. 94, RT 002/RW 007, Kel. Grogol, Jakarta Barat','08344963432','Duda'),
('3172000000000077','Rudi Saputra','L','Garut','1994-01-09','Jl. Melati No. 27, RT 006/RW 001, Kel. Tomang, Jakarta Barat','08278486317','Menikah'),
('3172000000000078','Ujang Hakim','L','Lampung','1993-07-08','Jl. Teratai No. 107, RT 002/RW 008, Kel. Duri Kepa, Jakarta Barat','08571658398','Janda'),
('3172000000000079','Iwan Kusuma','L','Jakarta','1980-05-16','Jl. Mawar No. 9, RT 003/RW 009, Kel. Duri Kosambi, Jakarta Barat','','Janda'),
('3172000000000080','Susi Utami','P','Garut','1960-03-17','Jl. Cempaka No. 37, RT 011/RW 002, Kel. Kembangan Utara, Jakarta Barat','08355237214','Janda'),
('3172000000000081','Ratna Wardhana','P','Indramayu','1977-03-19','Jl. Seroja No. 23, RT 011/RW 005, Kel. Duri Kepa, Jakarta Barat','08286216557','Menikah'),
('3172000000000082','Dewi Hidayat','P','Tegal','1984-05-28','Jl. Mawar No. 48, RT 009/RW 010, Kel. Kedoya Selatan, Jakarta Barat','08317991620','Menikah'),
('3172000000000083','Enung Setiawan','P','Garut','1958-07-20','Jl. Seroja No. 97, RT 013/RW 004, Kel. Kalideres, Jakarta Barat','08177459758','Menikah'),
('3172000000000084','Maman Saputra','L','Jakarta','1968-06-18','Jl. Dahlia No. 82, RT 009/RW 001, Kel. Tanjung Duren Selatan, Jakarta Barat','08191102019','Janda'),
('3172000000000085','Andi Saputra','L','Tegal','1976-09-15','Jl. Teratai No. 80, RT 015/RW 010, Kel. Joglo, Jakarta Barat','08151894509','Duda'),
('3172000000000086','Budi Wijaya','L','Tasikmalaya','1991-11-09','Jl. Flamboyan No. 90, RT 014/RW 006, Kel. Kembangan Utara, Jakarta Barat','08124456514','Belum Menikah'),
('3172000000000087','Iis Suryanto','P','Lampung','1977-01-22','Jl. Mawar No. 107, RT 011/RW 010, Kel. Srengseng, Jakarta Barat','08296823633','Janda'),
('3172000000000088','Wawan Wijaya','L','Tasikmalaya','1964-07-05','Jl. Anggrek No. 94, RT 009/RW 009, Kel. Rawa Buaya, Jakarta Barat','08347933152','Belum Menikah'),
('3172000000000089','Paino Setiadi','L','Tasikmalaya','1990-08-18','Jl. Cempaka No. 36, RT 001/RW 001, Kel. Kembangan Selatan, Jakarta Barat','08205420448','Janda'),
('3172000000000090','Sumiati Kusuma','P','Indramayu','1980-02-15','Jl. Teratai No. 98, RT 001/RW 004, Kel. Kapuk, Jakarta Barat','','Menikah'),
('3172000000000091','Budi Setiawan','L','Cirebon','1963-01-10','Jl. Dahlia No. 17, RT 001/RW 004, Kel. Grogol, Jakarta Barat','08506655172','Janda'),
('3172000000000092','Neneng Syahputra','P','Jakarta','1981-06-09','Jl. Kamboja No. 86, RT 004/RW 006, Kel. Kalideres, Jakarta Barat','08524042466','Menikah'),
('3172000000000093','Wawan Permana','L','Lampung','1971-12-09','Jl. Melati No. 81, RT 005/RW 005, Kel. Grogol, Jakarta Barat','08366126214','Janda'),
('3172000000000094','Salim','L','Cirebon','1991-09-04','Jl. Kamboja No. 5, RT 007/RW 010, Kel. Tomang, Jakarta Barat','08562031381','Janda'),
('3172000000000095','Hasan Gunawan','L','Serang','1980-02-11','Jl. Cempaka No. 13, RT 002/RW 006, Kel. Duri Kepa, Jakarta Barat','08585066388','Menikah'),
('3172000000000096','Zainal Pratama','L','Cirebon','1965-06-23','Jl. Mawar No. 79, RT 006/RW 005, Kel. Kedoya Utara, Jakarta Barat','08161177066','Duda'),
('3172000000000097','Aisyah Setiawan','P','Kuningan','1995-02-21','Jl. Teratai No. 21, RT 006/RW 010, Kel. Tanjung Duren Utara, Jakarta Barat','08504520294','Menikah'),
('3172000000000098','Ida Hakim','P','Lampung','2000-09-01','Jl. Cempaka No. 18, RT 014/RW 008, Kel. Tanjung Duren Utara, Jakarta Barat','08598853536','Janda'),
('3172000000000099','Ujang','L','Jakarta','2000-10-03','Jl. Anggrek No. 15, RT 001/RW 007, Kel. Kalianyar, Jakarta Barat','08525493375','Janda'),
('3172000000000100','Gunawan Hidayat','L','Tasikmalaya','1969-02-25','Jl. Anggrek No. 93, RT 009/RW 004, Kel. Joglo, Jakarta Barat','','Menikah'),
('3172000000000101','Karta Setiawan','L','Tasikmalaya','1973-05-06','Jl. Kamboja No. 72, RT 011/RW 003, Kel. Tanjung Duren Utara, Jakarta Barat','08218382998','Janda'),
('3172000000000102','Sugianto Utami','L','Tegal','1978-06-09','Jl. Anggrek No. 12, RT 001/RW 003, Kel. Pegadungan, Jakarta Barat','08125094925','Duda'),
('3172000000000103','Wawan Pratama','L','Lampung','1961-04-24','Jl. Teratai No. 94, RT 001/RW 002, Kel. Tomang, Jakarta Barat','08284007601','Duda'),
('3172000000000104','Neneng Hidayat','P','Cirebon','1990-11-09','Jl. Mawar No. 41, RT 003/RW 006, Kel. Meruya Selatan, Jakarta Barat','','Belum Menikah'),
('3172000000000105','Sutrisno Handayani','L','Tegal','1960-05-18','Jl. Mawar No. 38, RT 009/RW 009, Kel. Tanjung Duren Selatan, Jakarta Barat','08174627875','Janda'),
('3172000000000106','Suryani Permana','P','Cirebon','2000-03-24','Jl. Dahlia No. 94, RT 012/RW 004, Kel. Wijaya Kusuma, Jakarta Barat','','Menikah'),
('3172000000000107','Painem Yulianto','P','Jakarta','1972-02-06','Jl. Dahlia No. 17, RT 005/RW 009, Kel. Kapuk, Jakarta Barat','','Belum Menikah');

-- Penilaian sub kriteria untuk tiap pemohon di atas (dicocokkan berdasarkan NIK)
INSERT INTO penilaian_pemohon (pemohon_id, kriteria_id, sub_kriteria_id)
SELECT p.id, v.kriteria_id, v.sub_kriteria_id FROM pemohon p
JOIN (
  SELECT '3172000000000001' nik, 1 kriteria_id, 4 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000001' nik, 2 kriteria_id, 6 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000001' nik, 3 kriteria_id, 9 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000001' nik, 4 kriteria_id, 14 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000001' nik, 5 kriteria_id, 18 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000002' nik, 1 kriteria_id, 3 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000002' nik, 2 kriteria_id, 6 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000002' nik, 3 kriteria_id, 9 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000002' nik, 4 kriteria_id, 14 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000002' nik, 5 kriteria_id, 17 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000003' nik, 1 kriteria_id, 2 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000003' nik, 2 kriteria_id, 6 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000003' nik, 3 kriteria_id, 12 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000003' nik, 4 kriteria_id, 13 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000003' nik, 5 kriteria_id, 19 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000004' nik, 1 kriteria_id, 3 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000004' nik, 2 kriteria_id, 7 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000004' nik, 3 kriteria_id, 11 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000004' nik, 4 kriteria_id, 13 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000004' nik, 5 kriteria_id, 19 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000005' nik, 1 kriteria_id, 4 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000005' nik, 2 kriteria_id, 5 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000005' nik, 3 kriteria_id, 11 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000005' nik, 4 kriteria_id, 14 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000005' nik, 5 kriteria_id, 18 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000006' nik, 1 kriteria_id, 3 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000006' nik, 2 kriteria_id, 5 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000006' nik, 3 kriteria_id, 9 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000006' nik, 4 kriteria_id, 15 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000006' nik, 5 kriteria_id, 17 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000007' nik, 1 kriteria_id, 4 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000007' nik, 2 kriteria_id, 7 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000007' nik, 3 kriteria_id, 10 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000007' nik, 4 kriteria_id, 16 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000007' nik, 5 kriteria_id, 18 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000008' nik, 1 kriteria_id, 3 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000008' nik, 2 kriteria_id, 7 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000008' nik, 3 kriteria_id, 10 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000008' nik, 4 kriteria_id, 13 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000008' nik, 5 kriteria_id, 18 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000009' nik, 1 kriteria_id, 2 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000009' nik, 2 kriteria_id, 5 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000009' nik, 3 kriteria_id, 11 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000009' nik, 4 kriteria_id, 13 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000009' nik, 5 kriteria_id, 18 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000010' nik, 1 kriteria_id, 2 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000010' nik, 2 kriteria_id, 7 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000010' nik, 3 kriteria_id, 9 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000010' nik, 4 kriteria_id, 14 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000010' nik, 5 kriteria_id, 20 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000011' nik, 1 kriteria_id, 2 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000011' nik, 2 kriteria_id, 6 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000011' nik, 3 kriteria_id, 12 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000011' nik, 4 kriteria_id, 15 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000011' nik, 5 kriteria_id, 19 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000012' nik, 1 kriteria_id, 1 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000012' nik, 2 kriteria_id, 8 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000012' nik, 3 kriteria_id, 10 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000012' nik, 4 kriteria_id, 16 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000012' nik, 5 kriteria_id, 19 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000013' nik, 1 kriteria_id, 2 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000013' nik, 2 kriteria_id, 8 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000013' nik, 3 kriteria_id, 12 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000013' nik, 4 kriteria_id, 14 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000013' nik, 5 kriteria_id, 19 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000014' nik, 1 kriteria_id, 1 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000014' nik, 2 kriteria_id, 8 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000014' nik, 3 kriteria_id, 9 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000014' nik, 4 kriteria_id, 13 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000014' nik, 5 kriteria_id, 17 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000015' nik, 1 kriteria_id, 1 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000015' nik, 2 kriteria_id, 6 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000015' nik, 3 kriteria_id, 12 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000015' nik, 4 kriteria_id, 13 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000015' nik, 5 kriteria_id, 19 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000016' nik, 1 kriteria_id, 2 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000016' nik, 2 kriteria_id, 7 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000016' nik, 3 kriteria_id, 10 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000016' nik, 4 kriteria_id, 13 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000016' nik, 5 kriteria_id, 17 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000017' nik, 1 kriteria_id, 3 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000017' nik, 2 kriteria_id, 7 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000017' nik, 3 kriteria_id, 9 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000017' nik, 4 kriteria_id, 14 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000017' nik, 5 kriteria_id, 18 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000018' nik, 1 kriteria_id, 2 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000018' nik, 2 kriteria_id, 7 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000018' nik, 3 kriteria_id, 10 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000018' nik, 4 kriteria_id, 15 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000018' nik, 5 kriteria_id, 20 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000019' nik, 1 kriteria_id, 3 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000019' nik, 2 kriteria_id, 5 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000019' nik, 3 kriteria_id, 12 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000019' nik, 4 kriteria_id, 14 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000019' nik, 5 kriteria_id, 17 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000020' nik, 1 kriteria_id, 1 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000020' nik, 2 kriteria_id, 8 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000020' nik, 3 kriteria_id, 11 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000020' nik, 4 kriteria_id, 14 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000020' nik, 5 kriteria_id, 20 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000021' nik, 1 kriteria_id, 2 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000021' nik, 2 kriteria_id, 5 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000021' nik, 3 kriteria_id, 11 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000021' nik, 4 kriteria_id, 13 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000021' nik, 5 kriteria_id, 18 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000022' nik, 1 kriteria_id, 4 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000022' nik, 2 kriteria_id, 7 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000022' nik, 3 kriteria_id, 10 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000022' nik, 4 kriteria_id, 13 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000022' nik, 5 kriteria_id, 19 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000023' nik, 1 kriteria_id, 1 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000023' nik, 2 kriteria_id, 6 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000023' nik, 3 kriteria_id, 11 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000023' nik, 4 kriteria_id, 15 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000023' nik, 5 kriteria_id, 18 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000024' nik, 1 kriteria_id, 3 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000024' nik, 2 kriteria_id, 7 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000024' nik, 3 kriteria_id, 10 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000024' nik, 4 kriteria_id, 13 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000024' nik, 5 kriteria_id, 19 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000025' nik, 1 kriteria_id, 1 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000025' nik, 2 kriteria_id, 7 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000025' nik, 3 kriteria_id, 9 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000025' nik, 4 kriteria_id, 14 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000025' nik, 5 kriteria_id, 18 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000026' nik, 1 kriteria_id, 2 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000026' nik, 2 kriteria_id, 7 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000026' nik, 3 kriteria_id, 11 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000026' nik, 4 kriteria_id, 13 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000026' nik, 5 kriteria_id, 20 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000027' nik, 1 kriteria_id, 1 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000027' nik, 2 kriteria_id, 7 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000027' nik, 3 kriteria_id, 10 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000027' nik, 4 kriteria_id, 14 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000027' nik, 5 kriteria_id, 17 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000028' nik, 1 kriteria_id, 2 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000028' nik, 2 kriteria_id, 5 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000028' nik, 3 kriteria_id, 9 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000028' nik, 4 kriteria_id, 13 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000028' nik, 5 kriteria_id, 18 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000029' nik, 1 kriteria_id, 1 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000029' nik, 2 kriteria_id, 6 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000029' nik, 3 kriteria_id, 9 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000029' nik, 4 kriteria_id, 14 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000029' nik, 5 kriteria_id, 17 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000030' nik, 1 kriteria_id, 2 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000030' nik, 2 kriteria_id, 8 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000030' nik, 3 kriteria_id, 9 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000030' nik, 4 kriteria_id, 16 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000030' nik, 5 kriteria_id, 20 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000031' nik, 1 kriteria_id, 2 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000031' nik, 2 kriteria_id, 7 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000031' nik, 3 kriteria_id, 9 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000031' nik, 4 kriteria_id, 13 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000031' nik, 5 kriteria_id, 20 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000032' nik, 1 kriteria_id, 2 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000032' nik, 2 kriteria_id, 6 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000032' nik, 3 kriteria_id, 11 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000032' nik, 4 kriteria_id, 15 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000032' nik, 5 kriteria_id, 17 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000033' nik, 1 kriteria_id, 2 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000033' nik, 2 kriteria_id, 6 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000033' nik, 3 kriteria_id, 11 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000033' nik, 4 kriteria_id, 13 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000033' nik, 5 kriteria_id, 19 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000034' nik, 1 kriteria_id, 1 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000034' nik, 2 kriteria_id, 7 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000034' nik, 3 kriteria_id, 10 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000034' nik, 4 kriteria_id, 13 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000034' nik, 5 kriteria_id, 18 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000035' nik, 1 kriteria_id, 2 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000035' nik, 2 kriteria_id, 8 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000035' nik, 3 kriteria_id, 11 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000035' nik, 4 kriteria_id, 16 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000035' nik, 5 kriteria_id, 18 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000036' nik, 1 kriteria_id, 2 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000036' nik, 2 kriteria_id, 6 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000036' nik, 3 kriteria_id, 11 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000036' nik, 4 kriteria_id, 13 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000036' nik, 5 kriteria_id, 19 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000037' nik, 1 kriteria_id, 3 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000037' nik, 2 kriteria_id, 6 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000037' nik, 3 kriteria_id, 9 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000037' nik, 4 kriteria_id, 14 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000037' nik, 5 kriteria_id, 17 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000038' nik, 1 kriteria_id, 4 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000038' nik, 2 kriteria_id, 6 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000038' nik, 3 kriteria_id, 10 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000038' nik, 4 kriteria_id, 16 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000038' nik, 5 kriteria_id, 20 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000039' nik, 1 kriteria_id, 2 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000039' nik, 2 kriteria_id, 7 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000039' nik, 3 kriteria_id, 12 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000039' nik, 4 kriteria_id, 14 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000039' nik, 5 kriteria_id, 18 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000040' nik, 1 kriteria_id, 1 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000040' nik, 2 kriteria_id, 6 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000040' nik, 3 kriteria_id, 9 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000040' nik, 4 kriteria_id, 14 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000040' nik, 5 kriteria_id, 18 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000041' nik, 1 kriteria_id, 2 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000041' nik, 2 kriteria_id, 7 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000041' nik, 3 kriteria_id, 10 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000041' nik, 4 kriteria_id, 13 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000041' nik, 5 kriteria_id, 17 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000042' nik, 1 kriteria_id, 2 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000042' nik, 2 kriteria_id, 6 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000042' nik, 3 kriteria_id, 9 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000042' nik, 4 kriteria_id, 14 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000042' nik, 5 kriteria_id, 18 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000043' nik, 1 kriteria_id, 1 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000043' nik, 2 kriteria_id, 6 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000043' nik, 3 kriteria_id, 10 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000043' nik, 4 kriteria_id, 15 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000043' nik, 5 kriteria_id, 17 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000044' nik, 1 kriteria_id, 2 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000044' nik, 2 kriteria_id, 7 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000044' nik, 3 kriteria_id, 11 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000044' nik, 4 kriteria_id, 13 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000044' nik, 5 kriteria_id, 17 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000045' nik, 1 kriteria_id, 2 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000045' nik, 2 kriteria_id, 5 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000045' nik, 3 kriteria_id, 10 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000045' nik, 4 kriteria_id, 13 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000045' nik, 5 kriteria_id, 17 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000046' nik, 1 kriteria_id, 1 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000046' nik, 2 kriteria_id, 6 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000046' nik, 3 kriteria_id, 9 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000046' nik, 4 kriteria_id, 15 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000046' nik, 5 kriteria_id, 18 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000047' nik, 1 kriteria_id, 4 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000047' nik, 2 kriteria_id, 6 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000047' nik, 3 kriteria_id, 11 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000047' nik, 4 kriteria_id, 16 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000047' nik, 5 kriteria_id, 19 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000048' nik, 1 kriteria_id, 3 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000048' nik, 2 kriteria_id, 6 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000048' nik, 3 kriteria_id, 9 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000048' nik, 4 kriteria_id, 15 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000048' nik, 5 kriteria_id, 18 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000049' nik, 1 kriteria_id, 4 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000049' nik, 2 kriteria_id, 6 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000049' nik, 3 kriteria_id, 9 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000049' nik, 4 kriteria_id, 15 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000049' nik, 5 kriteria_id, 20 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000050' nik, 1 kriteria_id, 1 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000050' nik, 2 kriteria_id, 7 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000050' nik, 3 kriteria_id, 11 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000050' nik, 4 kriteria_id, 15 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000050' nik, 5 kriteria_id, 18 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000051' nik, 1 kriteria_id, 1 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000051' nik, 2 kriteria_id, 8 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000051' nik, 3 kriteria_id, 9 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000051' nik, 4 kriteria_id, 14 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000051' nik, 5 kriteria_id, 17 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000052' nik, 1 kriteria_id, 1 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000052' nik, 2 kriteria_id, 7 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000052' nik, 3 kriteria_id, 9 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000052' nik, 4 kriteria_id, 16 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000052' nik, 5 kriteria_id, 20 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000053' nik, 1 kriteria_id, 2 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000053' nik, 2 kriteria_id, 7 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000053' nik, 3 kriteria_id, 9 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000053' nik, 4 kriteria_id, 13 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000053' nik, 5 kriteria_id, 18 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000054' nik, 1 kriteria_id, 1 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000054' nik, 2 kriteria_id, 7 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000054' nik, 3 kriteria_id, 11 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000054' nik, 4 kriteria_id, 15 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000054' nik, 5 kriteria_id, 17 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000055' nik, 1 kriteria_id, 2 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000055' nik, 2 kriteria_id, 7 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000055' nik, 3 kriteria_id, 11 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000055' nik, 4 kriteria_id, 15 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000055' nik, 5 kriteria_id, 18 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000056' nik, 1 kriteria_id, 4 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000056' nik, 2 kriteria_id, 6 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000056' nik, 3 kriteria_id, 10 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000056' nik, 4 kriteria_id, 13 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000056' nik, 5 kriteria_id, 18 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000057' nik, 1 kriteria_id, 2 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000057' nik, 2 kriteria_id, 6 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000057' nik, 3 kriteria_id, 11 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000057' nik, 4 kriteria_id, 15 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000057' nik, 5 kriteria_id, 18 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000058' nik, 1 kriteria_id, 4 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000058' nik, 2 kriteria_id, 5 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000058' nik, 3 kriteria_id, 9 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000058' nik, 4 kriteria_id, 13 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000058' nik, 5 kriteria_id, 20 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000059' nik, 1 kriteria_id, 1 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000059' nik, 2 kriteria_id, 5 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000059' nik, 3 kriteria_id, 10 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000059' nik, 4 kriteria_id, 14 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000059' nik, 5 kriteria_id, 17 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000060' nik, 1 kriteria_id, 2 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000060' nik, 2 kriteria_id, 6 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000060' nik, 3 kriteria_id, 11 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000060' nik, 4 kriteria_id, 16 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000060' nik, 5 kriteria_id, 19 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000061' nik, 1 kriteria_id, 1 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000061' nik, 2 kriteria_id, 8 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000061' nik, 3 kriteria_id, 11 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000061' nik, 4 kriteria_id, 15 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000061' nik, 5 kriteria_id, 18 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000062' nik, 1 kriteria_id, 1 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000062' nik, 2 kriteria_id, 6 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000062' nik, 3 kriteria_id, 9 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000062' nik, 4 kriteria_id, 15 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000062' nik, 5 kriteria_id, 17 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000063' nik, 1 kriteria_id, 2 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000063' nik, 2 kriteria_id, 8 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000063' nik, 3 kriteria_id, 11 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000063' nik, 4 kriteria_id, 14 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000063' nik, 5 kriteria_id, 18 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000064' nik, 1 kriteria_id, 2 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000064' nik, 2 kriteria_id, 6 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000064' nik, 3 kriteria_id, 11 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000064' nik, 4 kriteria_id, 15 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000064' nik, 5 kriteria_id, 18 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000065' nik, 1 kriteria_id, 1 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000065' nik, 2 kriteria_id, 6 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000065' nik, 3 kriteria_id, 9 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000065' nik, 4 kriteria_id, 13 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000065' nik, 5 kriteria_id, 19 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000066' nik, 1 kriteria_id, 2 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000066' nik, 2 kriteria_id, 6 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000066' nik, 3 kriteria_id, 11 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000066' nik, 4 kriteria_id, 16 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000066' nik, 5 kriteria_id, 19 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000067' nik, 1 kriteria_id, 1 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000067' nik, 2 kriteria_id, 5 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000067' nik, 3 kriteria_id, 9 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000067' nik, 4 kriteria_id, 13 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000067' nik, 5 kriteria_id, 18 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000068' nik, 1 kriteria_id, 2 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000068' nik, 2 kriteria_id, 6 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000068' nik, 3 kriteria_id, 9 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000068' nik, 4 kriteria_id, 13 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000068' nik, 5 kriteria_id, 18 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000069' nik, 1 kriteria_id, 1 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000069' nik, 2 kriteria_id, 8 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000069' nik, 3 kriteria_id, 11 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000069' nik, 4 kriteria_id, 15 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000069' nik, 5 kriteria_id, 18 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000070' nik, 1 kriteria_id, 1 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000070' nik, 2 kriteria_id, 7 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000070' nik, 3 kriteria_id, 9 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000070' nik, 4 kriteria_id, 15 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000070' nik, 5 kriteria_id, 18 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000071' nik, 1 kriteria_id, 1 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000071' nik, 2 kriteria_id, 8 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000071' nik, 3 kriteria_id, 9 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000071' nik, 4 kriteria_id, 14 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000071' nik, 5 kriteria_id, 17 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000072' nik, 1 kriteria_id, 1 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000072' nik, 2 kriteria_id, 7 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000072' nik, 3 kriteria_id, 10 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000072' nik, 4 kriteria_id, 15 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000072' nik, 5 kriteria_id, 18 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000073' nik, 1 kriteria_id, 2 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000073' nik, 2 kriteria_id, 7 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000073' nik, 3 kriteria_id, 10 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000073' nik, 4 kriteria_id, 16 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000073' nik, 5 kriteria_id, 18 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000074' nik, 1 kriteria_id, 1 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000074' nik, 2 kriteria_id, 7 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000074' nik, 3 kriteria_id, 9 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000074' nik, 4 kriteria_id, 13 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000074' nik, 5 kriteria_id, 19 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000075' nik, 1 kriteria_id, 2 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000075' nik, 2 kriteria_id, 6 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000075' nik, 3 kriteria_id, 12 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000075' nik, 4 kriteria_id, 15 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000075' nik, 5 kriteria_id, 17 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000076' nik, 1 kriteria_id, 2 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000076' nik, 2 kriteria_id, 8 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000076' nik, 3 kriteria_id, 10 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000076' nik, 4 kriteria_id, 13 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000076' nik, 5 kriteria_id, 17 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000077' nik, 1 kriteria_id, 1 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000077' nik, 2 kriteria_id, 7 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000077' nik, 3 kriteria_id, 9 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000077' nik, 4 kriteria_id, 13 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000077' nik, 5 kriteria_id, 18 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000078' nik, 1 kriteria_id, 1 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000078' nik, 2 kriteria_id, 7 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000078' nik, 3 kriteria_id, 9 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000078' nik, 4 kriteria_id, 14 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000078' nik, 5 kriteria_id, 19 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000079' nik, 1 kriteria_id, 4 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000079' nik, 2 kriteria_id, 6 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000079' nik, 3 kriteria_id, 10 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000079' nik, 4 kriteria_id, 16 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000079' nik, 5 kriteria_id, 17 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000080' nik, 1 kriteria_id, 2 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000080' nik, 2 kriteria_id, 7 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000080' nik, 3 kriteria_id, 10 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000080' nik, 4 kriteria_id, 14 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000080' nik, 5 kriteria_id, 17 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000081' nik, 1 kriteria_id, 1 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000081' nik, 2 kriteria_id, 7 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000081' nik, 3 kriteria_id, 12 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000081' nik, 4 kriteria_id, 14 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000081' nik, 5 kriteria_id, 20 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000082' nik, 1 kriteria_id, 1 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000082' nik, 2 kriteria_id, 6 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000082' nik, 3 kriteria_id, 10 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000082' nik, 4 kriteria_id, 16 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000082' nik, 5 kriteria_id, 19 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000083' nik, 1 kriteria_id, 2 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000083' nik, 2 kriteria_id, 5 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000083' nik, 3 kriteria_id, 11 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000083' nik, 4 kriteria_id, 13 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000083' nik, 5 kriteria_id, 19 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000084' nik, 1 kriteria_id, 1 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000084' nik, 2 kriteria_id, 6 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000084' nik, 3 kriteria_id, 10 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000084' nik, 4 kriteria_id, 14 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000084' nik, 5 kriteria_id, 19 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000085' nik, 1 kriteria_id, 2 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000085' nik, 2 kriteria_id, 6 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000085' nik, 3 kriteria_id, 10 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000085' nik, 4 kriteria_id, 15 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000085' nik, 5 kriteria_id, 18 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000086' nik, 1 kriteria_id, 3 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000086' nik, 2 kriteria_id, 5 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000086' nik, 3 kriteria_id, 11 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000086' nik, 4 kriteria_id, 14 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000086' nik, 5 kriteria_id, 18 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000087' nik, 1 kriteria_id, 3 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000087' nik, 2 kriteria_id, 8 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000087' nik, 3 kriteria_id, 9 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000087' nik, 4 kriteria_id, 15 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000087' nik, 5 kriteria_id, 18 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000088' nik, 1 kriteria_id, 2 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000088' nik, 2 kriteria_id, 5 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000088' nik, 3 kriteria_id, 9 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000088' nik, 4 kriteria_id, 14 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000088' nik, 5 kriteria_id, 19 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000089' nik, 1 kriteria_id, 1 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000089' nik, 2 kriteria_id, 8 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000089' nik, 3 kriteria_id, 9 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000089' nik, 4 kriteria_id, 13 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000089' nik, 5 kriteria_id, 17 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000090' nik, 1 kriteria_id, 2 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000090' nik, 2 kriteria_id, 7 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000090' nik, 3 kriteria_id, 9 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000090' nik, 4 kriteria_id, 13 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000090' nik, 5 kriteria_id, 18 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000091' nik, 1 kriteria_id, 1 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000091' nik, 2 kriteria_id, 8 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000091' nik, 3 kriteria_id, 11 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000091' nik, 4 kriteria_id, 14 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000091' nik, 5 kriteria_id, 18 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000092' nik, 1 kriteria_id, 1 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000092' nik, 2 kriteria_id, 7 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000092' nik, 3 kriteria_id, 9 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000092' nik, 4 kriteria_id, 14 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000092' nik, 5 kriteria_id, 19 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000093' nik, 1 kriteria_id, 3 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000093' nik, 2 kriteria_id, 7 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000093' nik, 3 kriteria_id, 11 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000093' nik, 4 kriteria_id, 13 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000093' nik, 5 kriteria_id, 17 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000094' nik, 1 kriteria_id, 2 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000094' nik, 2 kriteria_id, 7 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000094' nik, 3 kriteria_id, 12 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000094' nik, 4 kriteria_id, 16 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000094' nik, 5 kriteria_id, 17 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000095' nik, 1 kriteria_id, 3 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000095' nik, 2 kriteria_id, 7 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000095' nik, 3 kriteria_id, 9 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000095' nik, 4 kriteria_id, 13 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000095' nik, 5 kriteria_id, 18 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000096' nik, 1 kriteria_id, 1 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000096' nik, 2 kriteria_id, 7 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000096' nik, 3 kriteria_id, 10 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000096' nik, 4 kriteria_id, 15 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000096' nik, 5 kriteria_id, 17 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000097' nik, 1 kriteria_id, 3 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000097' nik, 2 kriteria_id, 6 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000097' nik, 3 kriteria_id, 10 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000097' nik, 4 kriteria_id, 15 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000097' nik, 5 kriteria_id, 17 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000098' nik, 1 kriteria_id, 3 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000098' nik, 2 kriteria_id, 6 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000098' nik, 3 kriteria_id, 11 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000098' nik, 4 kriteria_id, 14 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000098' nik, 5 kriteria_id, 19 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000099' nik, 1 kriteria_id, 1 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000099' nik, 2 kriteria_id, 7 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000099' nik, 3 kriteria_id, 10 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000099' nik, 4 kriteria_id, 14 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000099' nik, 5 kriteria_id, 19 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000100' nik, 1 kriteria_id, 1 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000100' nik, 2 kriteria_id, 5 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000100' nik, 3 kriteria_id, 12 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000100' nik, 4 kriteria_id, 16 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000100' nik, 5 kriteria_id, 17 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000101' nik, 1 kriteria_id, 1 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000101' nik, 2 kriteria_id, 6 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000101' nik, 3 kriteria_id, 9 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000101' nik, 4 kriteria_id, 15 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000101' nik, 5 kriteria_id, 19 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000102' nik, 1 kriteria_id, 3 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000102' nik, 2 kriteria_id, 5 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000102' nik, 3 kriteria_id, 10 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000102' nik, 4 kriteria_id, 15 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000102' nik, 5 kriteria_id, 18 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000103' nik, 1 kriteria_id, 2 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000103' nik, 2 kriteria_id, 5 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000103' nik, 3 kriteria_id, 9 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000103' nik, 4 kriteria_id, 13 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000103' nik, 5 kriteria_id, 17 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000104' nik, 1 kriteria_id, 2 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000104' nik, 2 kriteria_id, 5 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000104' nik, 3 kriteria_id, 12 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000104' nik, 4 kriteria_id, 15 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000104' nik, 5 kriteria_id, 18 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000105' nik, 1 kriteria_id, 2 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000105' nik, 2 kriteria_id, 7 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000105' nik, 3 kriteria_id, 10 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000105' nik, 4 kriteria_id, 13 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000105' nik, 5 kriteria_id, 18 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000106' nik, 1 kriteria_id, 1 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000106' nik, 2 kriteria_id, 7 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000106' nik, 3 kriteria_id, 12 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000106' nik, 4 kriteria_id, 14 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000106' nik, 5 kriteria_id, 20 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000107' nik, 1 kriteria_id, 2 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000107' nik, 2 kriteria_id, 6 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000107' nik, 3 kriteria_id, 11 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000107' nik, 4 kriteria_id, 14 sub_kriteria_id
  UNION ALL
  SELECT '3172000000000107' nik, 5 kriteria_id, 17 sub_kriteria_id
) v ON v.nik = p.nik;
