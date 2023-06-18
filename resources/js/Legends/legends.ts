export default null;
export const Religion = Array(
    { id: 'roman-catholic', name: 'Roman Catholic' },
    { id: 'iglesia-ni-cristo', name: 'Iglesia Ni Cristo' },
    { id: 'islam', name: 'Islam' },
    { id: 'buddhism', name: 'Buddhism' },
    { id: 'hinduism', name: 'Hinduism' },
    { id: 'judaism', name: 'Judaism' },
    { id: 'atheism', name: 'Atheism' },
    { id: 'other', name: 'Other' },
);
export const BroughtBy = Array(
    { id: 'self', name: 'Self' },
    { id: 'police', name: 'Police' },
    { id: 'family', name: 'Family' },
    { id: 'neighbour', name: 'Neighbour' },
    { id: 'relative', name: 'Relative' },
    { id: 'friend', name: 'Friend' },
    { id: 'others', name: 'Others' },
    { id: 'unknown', name: 'Unknown' },
);
export const ArrivalCondition = Array(
    //good, fair, poor, shock, comatose, haemorrhagic, doa
    { id: 'good', name: 'Good' },
    { id: 'fair', name: 'Fair' },
    { id: 'poor', name: 'Poor' },
    { id: 'shock', name: 'Shock' },
    { id: 'comatose', name: 'Comatose' },
    { id: 'haemorrhagic', name: 'Haemorrhagic' },
    { id: 'doa', name: 'DOA' },
);
export const PurposesMedicalCertificate = Array([
    {id:1,name:'Pre-enrolment Medical Certification'},
    {id:2,name:'Educational tour/trip; seminar/convention'},
    {id:3,name:'Medical Requirement for On-the-job Training (OJT)'},
    {id:4,name:'Pre-participation Sports Clearance: Sports/Activity'},
    {id:5,name:'Others: Please Specify'},
]);
export const Disposition = Array(
    // treated and sent home, absconded, out when called, for admission, refused admission, hama/dama,  died transferred/reffered
    { id: 'treated-and-sent-home', name: 'Treated and Sent Home' },
    { id: 'absconded', name: 'Absconded' },
    { id: 'out-when-called', name: 'Out When Called' },
    { id: 'for-admission', name: 'For Admission' },
    { id: 'refused-admission', name: 'Refused Admission' },
    { id: 'hama-dama', name: 'HAMA/DAMA' },
    { id: 'died', name: 'Died' },
    { id: 'transferred-reffered', name: 'Transferred/Reffered' },
);

export const DepartCondition = Array(
    //stable, critical, expired
    { id: 'stable', name: 'Stable' },
    { id: 'critical', name: 'Critical' },
    { id: 'expired', name: 'Expired' },
);

export const TemperatureLocation = Array(
    { id: 'axilla', name: 'Axilla' },
    { id: 'oral', name: 'Oral' },
    { id: 'anal', name: 'Anal' },
);
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

export const InOutPatient = Array(
    {id:0, name:'Outpatient'},
    {id:1, name:'In-patient'},
);

export const BooleanValues = Array(
    {id:1, name:'Yes'},
    {id:0, name:'No'}
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
