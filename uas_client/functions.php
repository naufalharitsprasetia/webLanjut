<?php

require_once "db.php";

function query($query)
{
	global $conn;
	$result = mysqli_query($conn, $query);
	$rows = [];
	while ($row = mysqli_fetch_assoc($result)) {
		$rows[] = $row;
	}

	$conn->close();
	return $rows;
}

function tambah($data)
{
	global $conn;
	// ambil data dari tiap elemen dalam form
	$nim = htmlspecialchars($data["nim"]);
	$nama = htmlspecialchars($data["nama"]);

	// query INSERT DATA
	$query = "INSERT INTO mahasiswa (nim, nama)
				VALUES
				('" . $nim . "','" . $nama . "')
		";
	$conn->query($query);

	return mysqli_affected_rows($conn);
}