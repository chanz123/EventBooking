<?php
namespace Vendor\EventBooking\Setup;

use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\DB\Ddl\Table;

class InstallSchema implements InstallSchemaInterface
{
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();

        // Create event table
        if (!$setup->getConnection()->isTableExists($setup->getTable('event'))) {
            $table = $setup->getConnection()->newTable($setup->getTable('event'))
                ->addColumn('id', Table::TYPE_INTEGER, null, ['identity' => true, 'unsigned' => true, 'nullable' => false, 'primary' => true], 'Event ID')
                ->addColumn('title', Table::TYPE_TEXT, 255, ['nullable' => false], 'Event Title')
                ->addColumn('description', Table::TYPE_TEXT, '64k', ['nullable' => true], 'Event Description')
                ->addColumn('start_date', Table::TYPE_TIMESTAMP, null, ['nullable' => false], 'Start Date')
                ->addColumn('end_date', Table::TYPE_TIMESTAMP, null, ['nullable' => false], 'End Date')
                ->addColumn('country', Table::TYPE_TEXT, 255, ['nullable' => false], 'Event Country')
                ->addColumn('capacity', Table::TYPE_INTEGER, null, ['nullable' => false, 'default' => 0], 'Event Capacity')
                ->addColumn('created_by', Table::TYPE_INTEGER, null, ['nullable' => false], 'Created By (Admin ID)')
                ->setComment('Event Table');
            $setup->getConnection()->createTable($table);
        }

        // Create attendee table
        if (!$setup->getConnection()->isTableExists($setup->getTable('attendee'))) {
            $table = $setup->getConnection()->newTable($setup->getTable('attendee'))
                ->addColumn('id', Table::TYPE_INTEGER, null, ['identity' => true, 'unsigned' => true, 'nullable' => false, 'primary' => true], 'Attendee ID')
                ->addColumn('name', Table::TYPE_TEXT, 255, ['nullable' => false], 'Attendee Name')
                ->addColumn('email', Table::TYPE_TEXT, 255, ['nullable' => false], 'Attendee Email')
                ->addColumn('phone', Table::TYPE_TEXT, 15, ['nullable' => true], 'Attendee Phone')
                ->setComment('Attendee Table');
            $setup->getConnection()->createTable($table);
        }

        // Create event_booking table
        if (!$setup->getConnection()->isTableExists($setup->getTable('event_booking'))) {
            $table = $setup->getConnection()->newTable($setup->getTable('event_booking'))
                ->addColumn('id', Table::TYPE_INTEGER, null, ['identity' => true, 'unsigned' => true, 'nullable' => false, 'primary' => true], 'Booking ID')
                ->addColumn('event_id', Table::TYPE_INTEGER, null, ['nullable' => false], 'Event ID')
                ->addColumn('attendee_id', Table::TYPE_INTEGER, null, ['nullable' => false], 'Attendee ID')
                ->addColumn('booking_date', Table::TYPE_TIMESTAMP, null, ['nullable' => false], 'Booking Date')
                ->addForeignKey(
                    $setup->getFkName('event_booking', 'event_id', 'event', 'id'),
                    'event_id',
                    $setup->getTable('event'),
                    'id',
                    Table::ACTION_CASCADE
                )
                ->addForeignKey(
                    $setup->getFkName('event_booking', 'attendee_id', 'attendee', 'id'),
                    'attendee_id',
                    $setup->getTable('attendee'),
                    'id',
                    Table::ACTION_CASCADE
                )
                ->setComment('Event Booking Table');
            $setup->getConnection()->createTable($table);
        }

        $setup->endSetup();
    }
}
