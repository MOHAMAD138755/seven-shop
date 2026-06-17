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

    public function build($likes,$dislikes,$dates): \ArielMejiaDev\LarapexCharts\BarChart
    {
        return $this->chart->barChart()
            ->setTitle('لایک و دیسلایک')
            ->setSubtitle('نمایش تعداد لایک و دیسلایک')
            ->addData($likes, 'لایک ها')
            ->addData($dislikes, 'دیسلایک ها')
            ->setXAxis($dates);
    }
}
