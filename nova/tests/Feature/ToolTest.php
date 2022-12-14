<?php

namespace Laravel\Nova\Tests\Feature;

use Illuminate\Http\Request;
use Laravel\Nova\Nova;
use Laravel\Nova\Tests\IntegrationTestCase;
use Laravel\Nova\Tool;

class ToolTest extends IntegrationTestCase
{
    public function test_authorization_callback_is_executed()
    {
        Nova::$tools = [];

        Nova::tools([
            new class extends Tool
            {
                public function authorize(Request $request)
                {
                    return false;
                }
            },
        ]);

        $this->assertCount(0, Nova::availableTools(Request::create('/')));
    }
}
