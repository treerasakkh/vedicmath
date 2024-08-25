<?php

// tests/Unit/WelcomeViewTest.php

use Tests\TestCase;

class ShiftTest extends TestCase
{
    /** @test */
    public function it_shows_the_welcome_message_in_view()
    {
        // เรนเดอร์ View โดยตรง
        $view = $this->view('welcome');

        // ตรวจสอบว่ามีข้อความ "Welcome, John!" ใน HTML ของ View
        $view->assertSee('แบบวิธีทำ');
    }
}

