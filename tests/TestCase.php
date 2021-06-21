<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    use RefreshDatabase;
    use CreatesApplication;

    protected function setUp() : void
    {
        parent::setUp();

        $this->artisan('migrate',['-vvv' => true]);
        $this->artisan('passport:install',['-vvv' => true]);
        $this->artisan('db:seed',['-vvv' => true]);
    }

    public static function getTestTotalTablesList(): array
    {
        return DB::select("SELECT name FROM sqlite_master WHERE type IN ('table', 'view') AND name NOT LIKE 'sqlite_%' UNION ALL SELECT name FROM sqlite_temp_master WHERE type IN ('table', 'view') ORDER BY 1");
    }

    /**
     * 전체 테이블 리스트.
     */
    public static function printTotalTableList(): void
    {
        echo PHP_EOL . PHP_EOL;
        $tables = DB::select("SELECT name FROM sqlite_master WHERE type IN ('table', 'view') AND name NOT LIKE 'sqlite_%' UNION ALL SELECT name FROM sqlite_temp_master WHERE type IN ('table', 'view') ORDER BY 1");

        foreach ($tables as $table) {
            echo 'table-name: ' . $table->name . PHP_EOL;
            echo '(' . PHP_EOL;
            foreach (DB::getSchemaBuilder()->getColumnListing($table->name) as $columnName) {
                echo "\t" . $columnName . PHP_EOL;
            }
            echo ')' . PHP_EOL . PHP_EOL;
        }
        echo PHP_EOL;
    }
}
