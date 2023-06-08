<?php

namespace App\Models;

use DB;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WithdrawModel extends BaseModel
{
    use HasFactory;

    protected $table = 'withdraws';

    public $timestamps = false;

    public static function monthlyDashboard(){
        $sql = "SELECT
                    last_month.*,
                    last_1_month.*,
                    last_2_month.*,
                    last_3_month.*,

                    IFNULL(CAST(((last_month.last_month_wd - last_1_month.last_1_month_wd) / last_month.last_month_wd) * 100 AS DECIMAL(12, 2)), 0.0) as last_month_percentage,
                    IFNULL(CAST(((last_1_month.last_1_month_wd - last_2_month.last_2_month_wd) / last_1_month.last_1_month_wd) * 100 AS DECIMAL(12, 2)), 0.0) as last_1_month_percentage,
                    IFNULL(CAST(((last_2_month.last_2_month_wd - last_3_month.last_3_month_wd) / last_2_month.last_2_month_wd) * 100 AS DECIMAL(12, 2)), 0.0) as last_2_month_percentage,

                    CASE
                WHEN last_month.last_month_wd IS NOT NULL AND last_1_month.last_1_month_wd IS NOT NULL THEN
                    IF(last_month.last_month_wd > last_1_month.last_1_month_wd, 'Increase', 'Decrease')
                ELSE
                    'Static'
                    end as info_last_month,

                    CASE
                            WHEN last_1_month.last_1_month_wd IS NOT NULL AND last_2_month.last_2_month_wd IS NOT NULL THEN
                                    IF(last_1_month.last_1_month_wd > last_2_month.last_2_month_wd, 'Increase', 'Decrease')
                            ELSE
                                    'Static'
                    end as info_last_1_month,

                    CASE
                            WHEN last_2_month.last_2_month_wd IS NOT NULL AND last_3_month.last_3_month_wd IS NOT NULL THEN
                                    IF(last_2_month.last_2_month_wd > last_3_month.last_3_month_wd, 'Increase', 'Decrease')
                            ELSE
                                    'Static'
                    end as info_last_2_month
                FROM
                    (
                        SELECT
                            sum( amount ) AS last_month_wd,
                            MONTHNAME(request_date) as last_month_name
                        FROM
                            withdraws
                        WHERE
                            STATUS = 'approved'
                            AND MONTH(request_date) = MONTH(CURRENT_DATE)
                    ) as last_month,
                    (
                        SELECT
                            sum( amount ) AS last_1_month_wd,
                            MONTHNAME(request_date) as last_1_month_name
                        FROM
                            withdraws
                        WHERE
                            STATUS = 'approved'
                            AND MONTH(request_date) = MONTH(CURRENT_DATE) - 1
                    ) as last_1_month,
                    (
                        SELECT
                            sum( amount ) AS last_2_month_wd,
                            MONTHNAME(request_date) as last_2_month_name
                        FROM
                            withdraws
                        WHERE
                            STATUS = 'approved'
                            AND MONTH(request_date) = MONTH(CURRENT_DATE) - 2
                    ) as last_2_month,
                    (
                        SELECT
                            sum( amount ) AS last_3_month_wd,
                            MONTHNAME(request_date) as last_3_month_name
                        FROM
                            withdraws
                        WHERE
                            STATUS = 'approved'
                            AND MONTH(request_date) = MONTH(CURRENT_DATE) - 3
                    ) as last_3_month";

        $query = DB::select($sql);
        if (count($query) > 0) {
            return $query[0];
        }

        return [];
    }
}
