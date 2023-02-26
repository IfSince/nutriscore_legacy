import {FormField} from "../quest/form-field.js"
import {QuestStep} from "../quest/quest-step.js";
import {Quest} from "../quest/quest.js";
import {NutritionQuestStep} from './nutrition-quest-step.js';
import {OtherQuestStep} from './other-quest-step.js';

const accountQuestStep = new QuestStep(
    [
        new FormField('username', {}),
        new FormField('email', {}),
        new FormField('password', {}),
        new FormField('repeatPassword', {}),
        new FormField('acceptedTos', {}),
    ],
    document.querySelector('[data-quest-step="account"]'),
    'Account'
)

const personalQuestStep = new QuestStep(
    [
        new FormField('firstName', {}),
        new FormField('surname', {}),
        new FormField('dateOfBirth', {}),
        new FormField('height', {}),
        new FormField('gender', {}),
        new FormField('weight', {}),

    ],
    document.querySelector('[data-quest-step="personal"]'),
    'Personal'
)

const nutritionQuestStep = new NutritionQuestStep(
    [
        new FormField('nutritionType', {}),
        new FormField('protein', {}),
        new FormField('carbohydrates', {}),
        new FormField('fat', {}),
    ],
    document.querySelector('[data-quest-step="nutrition"]'),
    'Nutrition'
)

const othersQuestStep = new OtherQuestStep(
    [
        new FormField('bmrCalculationType', {}),
        new FormField('activityLevel', {}),
        new FormField('palLevel', {}),
        new FormField('goal', {}),
    ],
    document.querySelector('[data-quest-step="others"]'),
    'Others',
    true
)


const registrationQuest = new Quest(
    'registrationForm',
    [accountQuestStep, personalQuestStep, nutritionQuestStep, othersQuestStep]
)