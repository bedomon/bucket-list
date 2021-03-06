<?php


namespace App\DBAL\Types;


use DateTime;
use DateTimeInterface;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Platforms\PostgreSqlPlatform;
use Doctrine\DBAL\Types\ConversionException;
use Doctrine\DBAL\Types\Type;

/**
 * Override datetime datatype to support microseconds
 * @package App\DBAL\Type
 */
class DateTimeMicrosecondsType extends Type
{

    const TYPENAME = 'datetime';

    public function getSQLDeclaration(array $fieldDeclaration, AbstractPlatform $platform)
    {
        if (isset($fieldDeclaration['version']) && $fieldDeclaration['version'] == true) {
            return 'TIMESTAMP';
        }
//        dump($platform->getName());exit();
        if($platform->getName() == "postgresql")
            return 'TIMESTAMP(6) WITHOUT TIME ZONE';
        else
            return 'DATETIME(6)';

    }

    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        if ($value === null || $value instanceof DateTimeInterface) {
            return $value;
        }

        $val = DateTime::createFromFormat('Y-m-d H:i:s.u', $value);

        if ( ! $val) {
            $val = date_create($value);
        }

        if ( ! $val) {
            throw ConversionException::conversionFailedFormat(
                $value,
                $this->getName(),
                'Y-m-d H:i:s.u'
            );
        }

        return $val;
    }

    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        if (null === $value) {
            return $value;
        }

        if ($value instanceof DateTimeInterface) {
            return $value->format('Y-m-d H:i:s.u');
        }

        throw ConversionException::conversionFailedInvalidType(
            $value,
            $this->getName(),
            ['null', 'DateTime']
        );
    }

    public function getName()
    {
        return self::TYPENAME;
    }

    public function requiresSQLCommentHint(AbstractPlatform $platform)
    {
        return true;
    }


}