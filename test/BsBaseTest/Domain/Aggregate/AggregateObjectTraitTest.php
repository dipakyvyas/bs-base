<?php
namespace BsBaseTest\Domain\Aggregate;

use PHPUnit_Framework_TestCase;
use BsBase\Domain\Aggregate\Contact;
use Doctrine\Common\Collections\ArrayCollection;
use BsBase\Domain\Aggregate\Event;

/**
 *
 * @author florentguenebeaud
 *        
 */
class AggregateObjectTraitTest extends \PHPUnit_Framework_TestCase
{

    /**
     * Prepares the environment before running a test.
     */
    protected function setUp()
    {
        parent::setUp();
    }

    protected function getContactEntity()
    {
        // new Contact value object
        $contact = new Contact();
        $contact->setEmail('test@test.com');
        $contact->setName('name');
        $contact->setTelephone('33606060606');
        return $contact;
    }

    protected function getEventEntity()
    {
        // new Event Entity
        $event = new Event();
        $event->setDatetime(new \DateTime());
        $event->setDescription('description');
        $event->setMeta('meta');
        $event->setName(md5(time()));
        return $event;
    }

    /**
     * Cleans up the environment after running a test.
     */
    protected function tearDown()
    {
        $message = null;
        parent::tearDown();
    }

    /**
     * Tests Tag->hydrate()
     */
    public function testHydrate()
    {
        $array = array(
            'to' => $this->getContactEntity(),
            'from' => $this->getContactEntity(),
            'subject' => 'a subject',
            'message' => 'a message',
            'status' => 'a status',
            'events' => array(
                $this->getEventEntity(),
                $this->getEventEntity()
            )
        );
        $message = new Message();
        $message->hydrate($array);
        $this->assertSame($array['to'], $message->getTo());
        $this->assertSame($array['from'], $message->getFrom());
        $this->assertEquals($array['subject'], $message->getSubject());
        $this->assertEquals($array['status'], $message->getStatus());
        $this->assertSame($array['events'], $message->getEvents());
        $this->assertSameSize($array['events'], $message->getEvents());
    }

    /**
     * Tests Tag->hydrate()
     */
    public function testToArrayWithoutRecursion()
    {
        $event = $this->getEventEntity();
        $contact = $this->getContactEntity();
        $message = new Message();
        $message->setEvents(new ArrayCollection(array(
            $event,
            $event,
            $event
        )));
        $message->setFrom($contact);
        $message->setTo($contact);
        $message->setSubject('a subject');
        $message->setMessage('a message');
        $message->setStatus('a status');
        $array = $message->toArray();
        
        $this->assertSame($contact, $array['from']);
        $this->assertSame($contact, $array['to']);
        $this->assertEquals('a subject', $array['subject']);
        $this->assertEquals('a message', $array['message']);
        $this->assertEquals('a status', $array['status']);
        $this->assertSame($event, current($array['events']));
        $this->assertCount(3, $array['events']);
    }

    /**
     * Tests Tag->hydrate()
     */
    public function testToArrayWithRecursion()
    {
        $event = $this->getEventEntity();
        $contact = $this->getContactEntity();
        $message = new Message();
        $message->setEvents(new ArrayCollection(array(
            $event,
            $event,
            $event
        )));
        $message->setFrom($contact);
        $message->setTo($contact);
        $message->setSubject('a subject');
        $message->setMessage('a message');
        $message->setStatus('a status');
        $array = $message->toArray(true);
        
        $this->assertEquals($contact->toArray(true), $array['from']);
        $this->assertEquals($contact->toArray(true), $array['to']);
        $this->assertEquals('a subject', $array['subject']);
        $this->assertEquals('a message', $array['message']);
        $this->assertEquals('a status', $array['status']);
        $this->assertEquals($event->toArray(), current($array['events']));
        $this->assertCount(3, $array['events']);
    }
}

?>