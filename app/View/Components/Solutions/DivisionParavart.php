<?php

namespace App\View\Components\Solutions;

use App\Traits\EasyArray;
use App\Traits\Hang;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use stdClass;

class DivisionParavart extends Component
{
    use EasyArray, Hang;

    public int $dividend;
    public int $divisor;
    public array $paravart = [];
    public int $item;
    public string $question;
    public bool $showSolution;
    public bool $isM13;
    public array $tables;
    public int $startPosition = 0;
    public int $numLeftDividends = 0;
    public int $product;
    public int $remainder;
    public bool $isMore ;
    /**
     * Create a new component instance.
     */
    public function __construct(int $dividend, int $divisor, int $item, bool $showSolution, bool $isM13 = false)
    {
        $this->dividend = $dividend;
        $this->divisor = $divisor;
        $this->item = $item;
        $this->showSolution = $showSolution;
        $this->isM13 = $isM13;
        $this->tables = [];
        $this->product = intdiv($dividend, $divisor);
        $this->remainder = $dividend % $divisor;

        $this->start($dividend, $divisor);
    }

    protected function start(int $dividend, int $divisor): void
    {
        $this->question = $this->createQuestion($dividend, $divisor);

        for ($i = 0; $i < 3; $i++) {
            $table = $this->solve($dividend, $divisor);
            $this->tables[] = $table;
            $continue = $table->remainder >= $divisor || $table->remainder < 0;

            if($continue) {
                $dividend = $table->remainder;
            }else{
                break;
            }
        }

        if($i===3){
            $this->isMore = true;
        }else{
            $this->isMore = false;
        }
    }


    /**
     * แก้โจทย์
     *
     * @return void
     */
    public function solve(int $dividend, int $divisor): stdClass
    {
        $table = $this->createInitalTable($dividend, $divisor);
        $result = $this->createSolution($table, $dividend, $divisor);

        return $result;
    }

    /**
     * สร้างตารางหารเบื้องต้น
     *
     * @return void
     */
    protected function createInitalTable(int $dividend, int $divisor): array
    {

        $table = [];
        $dividendLength = $this->getLength($dividend);
        $divisorLength = strlen((string)$divisor);
        $paravartLength = $divisorLength - 1;
        $numColumns = $divisorLength + $dividendLength + 1;
        $numRows =  $dividendLength - $paravartLength + 2;

        $table = array_fill(0, $numRows, array_fill(0, $numColumns, "&nbsp;"));
        $table = $this->createFirstRow($table, $dividend, $divisor);
        $table = $this->createSecondRow($table, $divisor);
        return $table;
    }

    /**
     * สร้างการแก้โจทยัตามแนวพาราวารท
     *
     * @return void
     */
    protected function createSolution(array $table, int $dividend, int $divisor): stdClass
    {
        $dividendLength = $this->getLength($dividend);
        $divisorLength = $this->getLength($divisor);
        $numRows = count($table);
        $numColumns = count($table[0]);
        $numLeftDividends = $dividendLength - $divisorLength + 1;
        $startPosition = $divisorLength + 1;

        $arrDivisor = $this->make($divisor)->numberAll()->get();
        $paravart = array_map(fn ($x) => -$x, array_slice($arrDivisor, 1));

        for ($col = $startPosition; $col < $numColumns; $col++) {
            $sum = $this->getSummary($table, $col);
            $table[$numRows - 1][$col] = $sum;

            if ($col < $startPosition + $numLeftDividends) {

                $arrProduct = $this->multiplyParavart($paravart, $sum);
                $row = $col - $startPosition + 1;

                for ($i = 0; $i < count($arrProduct); $i++) {
                    $table[$row][$col + $i + 1] = $arrProduct[$i];
                }
            }
        }

        $arrProduct = array_slice($table[$numRows - 1], $startPosition,  $numLeftDividends);
        $arrRemainder = array_slice($table[$numRows - 1], - ($dividendLength - $numLeftDividends));

        $remainder = $this->getRemainder($arrRemainder);
        $product = $this->getRemainder($arrProduct);
  
        return (object)[
            'table' => $table,
            'tableFormat'=>$this->formatTable($table),
            'product'=>$product,
            'remainder' => $remainder,
            'startPosition'=>$startPosition,
            'numLeftDividend'=>$numLeftDividends,
        ];
    }

    protected function getRemainder(array $arrRemainder): int
    {
        $reverse = array_reverse($arrRemainder);
        $ramainder = 0;

        foreach ($reverse as $key => $value) {
            $ramainder += intval($value) * (10 ** $key);
        }
        return $ramainder;
    }
    protected function getLength(int $number): int
    {
        return strlen((string)$number);
    }

    /**
     * จัดรูปแบบตัวเลขติดลบเป็นติดบาร์ และตัวเลขเกิน 10 ให้ห้อยหน้า
     *
     * @return void
     */
    protected function formatTable(array $table): array
    {
        $numRows = count($table);
        $numColumns = count($table[0]);

        for ($row = 1; $row < $numRows; $row++) {
            for ($col = 1; $col < $numColumns; $col++) {
                $value = $table[$row][$col];
                if (is_numeric($value)) {
                    $value = $this->setNumber($value)->setDigitNormal(1)->formatNumber();
                }
                $table[$row][$col] = $value;
            }
        }

        return $table;
    }

    /**
     * ตัวหารแปลงแบบพาราวารทคูณกับผลรวมในแถวสุดท้าย
     *
     * @param integer $sum
     * @return array
     */
    protected function multiplyParavart(array $paravart, int $sum): array
    {
        return array_map(fn ($x) => $x * $sum, $paravart);
    }

    /**
     * หาผลรวมของแต่ละคอลัมน์ที่ต้องการในตาราง
     *
     * @param integer $column
     * @return integer
     */
    protected function getSummary(array $table, int $column): int
    {
        $columns = array_column(array_slice($table, 0, -1), $column);

        $summary = array_reduce($columns, function ($carry, $item) {
            return $carry + (is_numeric($item) ? $item : 0);
        }, 0);

        return $summary;
    }

    /**
     * สร้างตารางที่มีตัวหาร ) ตัวตั้ง
     *
     * @return void
     */
    protected function createFirstRow(array $table, int $dividend, int $divisor): array
    {
        if ($dividend < 0) {
            $arrDividend =  array_merge([-1], $this->make(10**$this->getLength(abs($dividend))+$dividend)->get());
        } else {
            $arrDividend = $this->make($dividend)->get();
        }

        $table[0] = array_merge($this->make($divisor)->get(), [')'], $arrDividend);
        return $table;
    }

    /**
     * ใส่ตัวเลขในแถวที่สอง 
     *
     * @return void
     */
    protected function createSecondRow(array $table, int $divisor): array
    {
        $arrDivisor = $this->make($divisor)->get();
        $arrParavart = array_map(fn ($digit) => -intval($digit), $arrDivisor);
        // $paravart = array_slice($arrParavart, 1);
        // 
        for ($i = 1; $i < count($arrParavart); $i++) {
            $table[1][$i] = $arrParavart[$i];
        }

        return $table;
    }

    /**
     * สร้างข้อคำถาม
     *
     * @return string
     */
    protected function createQuestion(int $dividend, int $divisor): string
    {
        return sprintf('%s &divide; %s', number_format($dividend), number_format($divisor));
    }
    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.solutions.division-paravart');
    }
}
