<?php

namespace app\models;

use app\components\UuidBehavior;
use \yii\db\ActiveRecord;
use Yii;

/**
 * This is the model class for table "specimen".
 *
 * @property string $id
 * @property string $specimenId
 * @property string $country
 * @property string $countryCodeIso
 * @property string $administrative_area_level_1 // administrativeArea
 * @property string $administrative_area_level_2 // subAdministrativeArea
 * @property string $administrative_area_level_3 // administrativeLocality
 * @property string $locality                    // administrativeSubLocality
 * @property string $sublocality
 * @property double $latitude
 * @property double $longitude
 * @property integer $horizontalAccuracy
 * @property integer $altitude
 * @property integer $verticalAccuracy
 * @property string $idAllday
 * @property string $beginDate
 * @property string $isInDaylight
 * @property string $endDate
 * @property string $legit
 * @property string $localityName
 * @property string $localityDescription
 * @property string $localityPrefix
 * @property string $localityMajorId
 * @property string $localityMinorId
 * @property string $mgrs
 * @property string $circumstance
 * @property string $wetherConditions
 * @property string $label
 * @property string $fieldsMeta
 */
/*

 Some fields:

 wetherConditions = {
    // for migration of older dairy entries
    "text":"Sonnig warm, leicht bewölkt",
    // for sensor tag measurement:
    "humidity":null,
    "pressure":null,
    "temperature":null
    // more for the big wether picture
    // ...
 }

// migrate older entolabel-tool into fieldworksdiary:
label = {
  lt:'cGooAxUsFdRiDXH0BbDwYg==',
  l:['Germany, Bavaria',
     'Würzburg',
     'Thüngersheim'
     '10. IV 2011'
    ],
  vl:['leg. J. Brunner']
}

// since we can overwrite some fields with data from external data
// fieldMeta configures the input sources. Manual edited fields should not
// be overwritten by a service...
fieldMeta = {
  "reverseGeocode": {
    "lang":"en",
      "overwritten":['administrative_area_level_2']
    }
}

 */
class Specimen extends \yii\db\ActiveRecord
{
    // extent the table properties for converting
    // and automatically retrieving data
    public $inputFormat = 'geodeticdecimal';
    public $geoCodeLanguage = 'en';
    public $utm;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'specimen';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'specimenId', 'country', 'beginDate'], 'required'],
            [['specimenId'], 'unique'],
            [['latitude', 'longitude'], 'number'],
            [['horizontalAccuracy', 'altitude', 'verticalAccuracy'], 'integer'],
            [['beginDate', 'endDate'], 'safe'],
            [['circumstance', 'wetherConditions', 'label', 'fieldsMeta'], 'string'],
            [['id'], 'string', 'max' => 48],
            [['specimenId'], 'string', 'max' => 20],
            [['country', 'administrative_area_level_1', 'administrative_area_level_2', 'administrative_area_level_3', 'locality', 'sublocality', 'legit', 'localityName'], 'string', 'max' => 200],
            [['countryCodeIso'], 'string', 'max' => 2],
            [['localityDescription'], 'string', 'max' => 1000],
            [['localityPrefix', 'localityMajorId', 'localityMinorId'], 'string', 'max' => 100],
            [['mgrs'], 'string', 'max' => 18]
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        $scenarios = parent::scenarios();
        $scenarios['reverseGeolocate'] = ['inputFormat', 'geoCodeLanguage'];

        return $scenarios;
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'Reference of specimen'),
            'specimenId' => Yii::t('app', 'Your reference'),
            'country' => Yii::t('app', 'Country'),
            'countryCodeIso' => Yii::t('app', 'Country Code Iso'),
            'administrative_area_level_1' => Yii::t('app', 'Administrative Area (e.g. Bavaria)'),
            'administrative_area_level_2' => Yii::t('app', 'Sub Administrative Area (e.g. Lower Franconia)'),
            'administrative_area_level_3' => Yii::t('app', 'Administrative Locality (e.g. Würzburg'),
            'locality' => Yii::t('app', 'Locality'),
            'sublocality' => Yii::t('app', 'Sublocality'),
            'latitude' => Yii::t('app', 'Latitude'),
            'longitude' => Yii::t('app', 'Longitude'),
            'horizontalAccuracy' => Yii::t('app', 'horizontal Accuracy [m]'),
            'altitude' => Yii::t('app', 'Altitude [m]'),
            'verticalAccuracy' => Yii::t('app', 'vert. Accuracy[m]'),
            'beginDate' => Yii::t('app', 'Begin Date'),
            'endDate' => Yii::t('app', 'End Date'),
            'legit' => Yii::t('app', 'Sampled by (legit)'),
            'localityName' => Yii::t('app', 'Name of locality'),
            'localityDescription' => Yii::t('app', 'Locality Description'),
            'localityPrefix' => Yii::t('app', 'Locality Prefix'),
            'localityMajorId' => Yii::t('app', 'Locality Major ID'),
            'localityMinorId' => Yii::t('app', 'Locality Minor ID'),
            'mgrs' => Yii::t('app', 'Mgrs'),
            'circumstance' => Yii::t('app', 'Circumstance'),
            'wetherConditions' => Yii::t('app', 'Wether Conditions'),
            'label' => Yii::t('app', 'Label'),
            'fieldsMeta' => Yii::t('app', 'Meta-Daten zu den Feldern'),
        ];
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'Specimen' => [
                'class' => UuidBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['id'],
                ],
            ],
        ];
    }

    public function reverseGeolocate()
    {
        // Validation should be dependent on inputFormat (perhaps bad design yet).
        // Next step would be to convert coodinates in inputFormat to
        // geodetic decimal (WGS84) that is the standard coordinate format.
        // Last step then is to search the geo location in reverse way by coordinates.

        if ($this->inputFormat == 'geodeticdecimal') {

            $this->_findLocation();
        } else {

            return false;
        }

        return true;
    }

    protected function _findLocation()
    {
        $lat      = $this->latitude;
        $lng      = $this->longitude;
        $language = $this->geoCodeLanguage;

        $location = ['country'                     => null,
                     'administrative_area_level_1' => null,
                     'administrative_area_level_2' => null,
                     'administrative_area_level_3' => null,
                     'locality'                    => null,
                     'sublocality'                 => null];

        if (empty($lat) || empty($lng)) {

            return $this;
        }

//        $protocol = 'http';
//
//        if (!empty($_SERVER['HTTPS'])) {
//
//            $protocol = ($_SERVER['HTTPS']) ? "https" : "http";
//        }

        $curl   = curl_init(sprintf('http://maps.googleapis.com/maps/api/geocode/json?latlng=%f,%f&sensor=false&language=%s', $lat, $lng, $language));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
        $result = curl_exec($curl) ;
        curl_close($curl);

        $result     = json_decode($result);

        foreach ($result->results as $components) {
            foreach ($components->address_components as $class) {
                $return = array_intersect($class->types, array_keys($location));
                if (!empty($return)) {
                    $this->{$return[0]} = $class->long_name;

                    // hack, to get ISO code from country
                    if ($return[0] == 'country') {
                        $this->countryCodeIso = $class->short_name;
                    }
                }
            }
        }

        return $this;
    }
}
