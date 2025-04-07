import { InputField } from '@/components/forms/inputs/InputField';
import SubmitButton from '@/components/forms/SubmitButton';
import { PageTitle } from '@/components/PageTitle';
import { Card, CardContent, CardFooter } from '@/components/ui/card';
import AppLayout from '@/layouts/app-layout';
import { Member } from '@/types/models/member';
import { useForm, usePage } from '@inertiajs/react';
import { useLaravelReactI18n } from 'laravel-react-i18n';

type CreateForm = Required<Omit<Member, 'id' | 'deleted_at' | 'created_at' | 'updated_at'>>;

export default function Create() {
    console.log(usePage().props);
    const { t } = useLaravelReactI18n();
    const { data, setData, post, errors, processing } = useForm<CreateForm>({
        civil_status: '',
        dob: '',
        gender: '',
        last_name: '',
        phone: '',
        name: '',
        email: '',
    });

    const handleSubmit = (e: React.FormEvent) => {
        e.preventDefault();
        post(route('members.store'));
    };

    return (
        <AppLayout title={t('Members')}>
            <PageTitle>{t('Add Member')}</PageTitle>
            <div className="mt-2 flex items-center justify-center">
                <form className="w-full max-w-2xl" onSubmit={handleSubmit}>
                    <Card>
                        <CardContent className="space-y-4">
                            <InputField label="Name" value={data.name} onChange={(value) => setData('name', value)} error={errors.name} />
                            <InputField
                                label="Last Name"
                                value={data.last_name}
                                onChange={(value) => setData('last_name', value)}
                                error={errors.last_name}
                            />
                            <InputField label="Email" value={data.email} onChange={(value) => setData('email', value)} error={errors.email} />
                            <InputField label="Phone" value={data.phone} onChange={(value) => setData('phone', value)} error={errors.phone} />
                            <InputField label="Date of Birth" value={data.dob} onChange={(value) => setData('dob', value)} error={errors.dob} />
                            <InputField label="Gender" value={data.gender} onChange={(value) => setData('gender', value)} error={errors.gender} />
                            <InputField
                                label="Civil Status"
                                value={data.civil_status}
                                onChange={(value) => setData('civil_status', value)}
                                error={errors.civil_status}
                            />
                        </CardContent>
                        <CardFooter className="flex justify-end">
                            <SubmitButton isSubmitting={processing}>{t('Submit')}</SubmitButton>
                        </CardFooter>
                    </Card>
                </form>
            </div>
        </AppLayout>
    );
}
