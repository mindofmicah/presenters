<?php

namespace spec\Mindofmicah\Presenter;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

use Mockery;
class PresentableTraitSpec extends ObjectBehavior
{
    public function let()
    {
        $this->beAnInstanceOf('spec\mindofmicah\Presenter\Foo');
    }
    function it_is_initializable()
    {
        $this->shouldHaveType('spec\mindofmicah\Presenter\Foo');
    }

    public function it_fetches_a_valid_presenter()
    {
        Mockery::mock('FooPresenter');
        $this->present()->shouldBeAnInstanceOf('FooPresenter');
    }
    public function it_throws_up_if_invalid_presenter_is_provided()
    {
        $this->presenter = 'Invalid';
        $this->shouldThrow('Mindofmicah\Presenter\Exceptions\PresenterException')->duringPresent();
    }
    public function it_caches_the_presenter_for_future_use()
    {
        Mockery::mock('FooPresenter');
        $one = $this->present();
        $two = $this->present();

        $one->shouldBe($two);
    }
}

use Mindofmicah\Presenter\PresentableTrait;
class Foo
{
    use PresentableTrait;

    public $presenter = 'FooPresenter';
}
