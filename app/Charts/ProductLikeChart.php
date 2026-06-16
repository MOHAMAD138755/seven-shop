<?php

namespace App\Charts;

use ArielMejiaDev\LarapexCharts\LarapexChart;

class ProductLikeChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build($likes,$dislikes,$date): \ArielMejiaDev\LarapexCharts\LineChart
    {
        return $this->chart->lineChart()
            ->setTitle(' لایک ها و دیسلایک')
            ->setSubtitle('بررسی لایک ها و دیسلایک ها در نمودار')
            ->addData($likes, 'لایک ها')
            ->addData($dislikes,'دیسلایک ها')
            ->setXAxis($date);
    }
}
