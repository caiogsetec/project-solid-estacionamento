<?php

$db = new SQLite3(__DIR__ . '/../database.sqlite');

$db->exec("
    CREATE TABLE IF NOT EXISTS parking_records (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        plate TEXT NOT NULL,
        type TEXT NOT NULL,
        entry_time TEXT NOT NULL,
        exit_time TEXT,
        price REAL
    );
");

echo 'Banco de dados [database.sqlite] criado com sucesso!';
