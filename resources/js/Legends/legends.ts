export default null;
export const BloodType = Array(
    { id: 'O+', name: 'O+' },
    { id: 'O-', name: 'O-' },
    { id: 'A+', name: 'A+' },
    { id: 'A-', name: 'A-' },
    { id: 'B+', name: 'B+' },
    { id: 'B-', name: 'B-' },
    { id: 'AB+', name: 'AB+' },
    { id: 'AB-', name: 'AB-' },
);
export const Sex = Array(
    { id: 'male', name: 'Male' },
    { id: 'female', name: 'Female' },
);
export const CivilStatus = Array(
    { id: 'single', name: 'Single' },
    { id: 'married', name: 'Married' },
    { id: 'widowed', name: 'Widowed' },
    { id: 'separated', name: 'Separated' },
    { id: 'divorced', name: 'Divorced' },
);
export const YearLevel = Array(
    { id: '1st', name: '1st' },
    { id: '2nd', name: '2nd' },
    { id: '3rd', name: '3rd' },
    { id: '4th', name: '4th' },
    { id: '5th', name: '5th' },
    { id: '6th', name: '6th' },
);

export const AcademicGroup = Array(
    { id: 'bachelor', name: 'Bachelor' },
    { id: 'master', name: 'Master' },
    { id: 'doctor', name: 'Doctorate' },
);

export const RecordStatus = Array(
    {id: 'pending', name: 'Pending'},
    {id:'done', name: 'Done'},
    {id: 'released', name: 'Released'},
);

export const WardType = Array(
    {id: 'opd', name: 'OPD'},
    {id: 'er', name: 'ER'},
    {id: 'male-ward', name: 'Male Ward'},
    {id: 'female-ward', name: 'Female Ward'},
    {id: 'pedia-ward', name: 'Pedia Ward'},
    {id: 'iso-1', name: 'ISO 1'},
    {id: 'iso-2', name: 'ISO 2'},
);

export const Lab_Group_1 = Array(
    {id:'negative', name:'Negative'},
    {id:'positive', name:'Positive'},
    {id:'trace', name:'Trace'},
    {id:'1+', name:'1+'},
    {id:'2+', name:'2+'},
    {id:'3+', name:'3+'},
    {id:'4+', name:'4+'},
);

export const Lab_Group_2 = Array(
    {id:'negative', name:'Negative'},
    {id:'positive', name:'Positive'}
);

export const Lab_Group_3 = Array(
    {id:'negative', name:'Negative'},
    {id:'increased', name:'Increased'},
    {id:'normal', name:'Normal'},
    {id:'decreased', name:'Decreased'},
);

export const Lab_Group_4 = Array(
    { id: '0-2', name: '0-2' },
    { id: '0-5', name: '0-5' },
    { id: '6-10', name: '6-10' },
    { id: '11-20', name: '11-20' },
    { id: '21-50', name: '21-50' },
    { id: '51-100', name: '51-100' },
    { id: '>100', name: '>100' },
);

export const Lab_Group_5 = Array(
    { id: 'clear', name: 'Clear' },
    { id: 'slightly-turbid', name: 'Slightly Turbid' },
    { id: 'turbid', name: 'Turbid' },
);

export const Lab_Group_6 = Array(
    { id: 'soft', name: 'Soft' },
    { id: 'loose', name: 'Loose' },
    { id: 'watery', name: 'Watery' },
    { id: 'formed', name: 'Formed' },
    { id: 'hard', name: 'Hard' },
);
export {};
