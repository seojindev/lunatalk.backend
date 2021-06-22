<?php

namespace Tests;

use Illuminate\Support\Facades\DB;

class BaseCustomTestCase extends TestCase
{
    protected function setUp() : void
    {
        parent::setUp();
    }

    /**
     * 전체 테이블 리스트.
     *
     * @return array
     */
    public static function getTestTotalTablesList() : array
    {
        return DB::select("SELECT name FROM sqlite_master WHERE type IN ('table', 'view') AND name NOT LIKE 'sqlite_%' UNION ALL SELECT name FROM sqlite_temp_master WHERE type IN ('table', 'view') ORDER BY 1");
    }

    /**
     * 전체 테이블 리스트.
     */
    public static function printTotalTableList() : void
    {
        echo PHP_EOL.PHP_EOL;
        $tables = DB::select("SELECT name FROM sqlite_master WHERE type IN ('table', 'view') AND name NOT LIKE 'sqlite_%' UNION ALL SELECT name FROM sqlite_temp_master WHERE type IN ('table', 'view') ORDER BY 1");

        foreach($tables as $table)
        {
            echo "table-name: ".$table->name.PHP_EOL;
            echo "(".PHP_EOL;
            foreach(DB::getSchemaBuilder()->getColumnListing($table->name) as $columnName) {
                echo "\t".$columnName.PHP_EOL;
            }
            echo ")".PHP_EOL.PHP_EOL;
        }
        echo PHP_EOL;
    }

    /**
     * 해당 테이블 컬럼 리스트.
     * @param string $tableName
     * @return array
     */
    public static function getTableColumnList(string $tableName = "") : array
    {
        return DB::getSchemaBuilder()->getColumnListing($tableName);
    }

    /**
     * Request Header.
     * @return string[]
     */
    public static function getTestApiHeaders() : array
    {
        return [
            'Request-Client-Type' => config('extract.clientType.front.code'),
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
            'Authorization' => ''
        ];
    }

    /**
     * 관리자 테스트용 토큰 포함 해더.
     * @return string[]
     */
    protected function getTestAccessTokenHeader() : array
    {
        $response = $this->withHeaders($this->getTestApiHeaders())->postjson('/api/v1/auth/login', [
            "login_id" => \App\Models\User::where('user_level', 'S020900')->orderBy('id', 'ASC')->first()->login_id,
            "login_password" => 'password'
        ]);
        return [
            'Request-Client-Type' => config('extract.clientType.front.code'),
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer '.$response['result']['access_token']
        ];
    }

    /**
     * 일반 로그인 사용자 테스트용 헤더.
     * @return string[]
     */
    protected function getTestGuestAccessTokenHeader() : array
    {
        $response = $this->withHeaders($this->getTestApiHeaders())->postjson('/api/v1/auth/login', [
            "login_id" => \App\Models\User::where('user_level', 'S020010')->orderBy('id', 'ASC')->first()->login_id,
            "login_password" => 'password'
        ]);
        return [
            'Request-Client-Type' => config('extract.clientType.front.code'),
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer '.$response['result']['access_token']
        ];
    }
}
